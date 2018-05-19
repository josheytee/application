<?php

namespace ntc\product\form;

use app\core\controller\FormController;
use app\core\entity\Product;
use app\core\entity\ProductImage;
use app\core\http\Request;
use app\core\utility\ImageUploadTrait;
use app\core\view\form\Checkbox;
use app\core\view\form\File;
use app\core\view\form\Formbuilder;
use app\core\view\form\Radio;
use app\core\view\form\Select;
use app\core\view\form\Submit;
use app\core\view\form\Text;
use app\core\view\form\TextArea;
use ntc\section\form\field\SectionParent;
use ntc\shop\form\field\CurrentShop;

class ProductForm extends FormController
{

    use ImageUploadTrait;

    public function __construct()
    {
        $this->tmp_dir = __DIR__ . '/../../uploads/tmp';
        $this->upload_dir = __DIR__ . '/../../uploads';
        $this->tmp_dir_route = 'admin.product.image.temp.url';
        $this->image_model = ProductImage::class;
        $this->image_model_foreign_key = 'product_id';
    }

    public function build(Formbuilder $builder, $entity = 0)
    {
        $builder->add('shop_id', CurrentShop::class);
        $builder->add('type', Radio::class, function ($type) {
            $type->radios = [
                'simple' => 'Standard product',
                'pack' => 'pack of existing product',
                'virtual' => 'Virtual product(services,booking,downloadable products, etc.'
            ];
        });
        $builder->add('name', Text::class);
        $builder->add('description', TextArea::class);
        $builder->add('section_id', SectionParent::class, function ($section) {
            $section->label = "section";
        });
        $builder->add('price', Text::class);
        $builder->add('options', Checkbox::class, function ($options) {
            $options->checks = [
                'active',
                'availability' => [
                    'label' => 'Available for order',
                    'value' => 1,
                ],
            ];
        });
        $builder->add('condition', Select::class, function ($condition) {
            $condition->options = [
                'new' => 'New',
                'used' => 'Used',
                'refurbished' => 'Refurbished.'
            ];
        });

//        $builder->add('availability', Text::class);
        $builder->add('meta_title', Text::class);
        $builder->add('meta_description', Text::class);
        $builder->add('meta_keywords', Text::class);
        $builder->add('link_rewrite', Text::class);
        $builder->add('quantity', Text::class);
        $builder->add('quantity_discount', Text::class);
        $builder->add('minimal_quantity', Text::class);
        $builder->add('images', File::class, function ($images) {
            $images->uploadUrl = "http://localhost/application/admin/product/image/upload";
            $images->deleteUrl = "http://localhost/application/admin/product/image/delete/";
        });

        $builder->addSubmit('addProduct');
        return $builder;
    }

    public function createEntity(Request $request)
    {
//        dump($request->all());
        $rawProductData = $request->all();
        $productModelData = array_diff_key($rawProductData, ['images' => []]);
//        dump($productModelData);

        $product = Product::create($productModelData);

        $dir = $this->upload_dir . '/' . $product->id;
        is_dir($dir) ?: mkdir($dir);
        foreach ((array) $request->images as $id => $name) {
            $from = realpath($this->tmp_dir . '/' . $name);
            $to = $dir . '/' . $name;
            if (rename($from, $to))
            {
                ProductImage::where('id', $id)->update([
                    'path' => $this->generateUrl('admin.product.image.url', ['id' => $product->id, 'name' => $name]),
                    'product_id' => $product->id
                ]);
            }
        }
        return true;
    }

    protected function updateEntity(Request $request, $id)
    {
//        dump($request->all());
        $rawProductData = $request->all();
        $productModelData = array_diff_key($rawProductData, ['images' => []]);
//        dump($productModelData);


        Product::where('id', $id)->update($productModelData);

        $dir = $this->upload_dir . '/' . $id;
        is_dir($dir) ?: mkdir($dir);
        foreach ((array) $request->images as $img_id => $name) {
            $from = realpath($this->tmp_dir . '/' . $name);
            $to = $dir . '/' . $name;
            if (rename($from, $to))
            {
                ProductImage::where('id', $img_id)->update([
                    'path' => $this->generateUrl('admin.product.image.url', ['id' => $id, 'name' => $name]),
                    'product_id' => $id
                ]);
            }
        }
        return true;
    }

}
