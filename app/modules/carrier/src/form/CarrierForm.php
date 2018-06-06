<?php

namespace ntc\carrier\form;

use app\core\controller\FormController;
use app\core\entity\Carrier;
use app\core\http\Request;
use app\core\utility\ImageUploadTrait;
use app\core\view\form\Checkbox;
use app\core\view\form\Formbuilder;
use app\core\view\form\SingleFile;
use app\core\view\form\Text;
use ntc\shop\form\field\CurrentShop;

class CarrierForm extends FormController
{
    use ImageUploadTrait;

    public function __construct()
    {
        $this->tmp_dir = __DIR__ . '/../../uploads/tmp';
        $this->upload_dir = __DIR__ . '/../../uploads';
        $this->tmp_dir_route = 'admin.carrier.image.temp.url';
        $this->image_model = ProductImage::class;
        $this->image_model_foreign_key = 'product_id';
    }

    public function build(Formbuilder $builder)
    {
        $builder->add('shop_id', CurrentShop::class);
        $builder->add('name', Text::class);
        $builder->add('url', Text::class);
        $builder->add('price', Text::class);
        $builder->add('options', Checkbox::class, function ($options) {
            $options->checks = [
                'active',
                'is_free'
            ];
        });
        $builder->add('max_width', Text::class);
        $builder->add('max_height', Text::class);
        $builder->add('max_depth', Text::class);
        $builder->add('max_weight', Text::class);
        $builder->add('delay', Text::class);
        $builder->add('grade', Text::class);
        $builder->add('logo', SingleFile::class);
        $builder->addSubmit('save');
        return $builder;
    }

    public function createEntity(Request $request)
    {

        $carrier = Carrier::create($request->all());
        if ($carrier) {
            $logo = $request->file('logo');
            $name = time() . $logo->getClientOriginalName();
            $logo->move(__DIR__ . '/../../uploads/' . $carrier->id, $name);
            return $carrier->update(['logo' => $this->generateUrl('carrier.logo.url', [
                'id' => $carrier->id,
                'name' => $name,
            ])]);
        }
        return false;
    }
}