<?php

namespace ntc\section\form;

use app\core\controller\FormController;
use app\core\entity\Section;
use app\core\entity\SectionImage;
use app\core\http\Request;
use app\core\utility\ImageUploadTrait;
use app\core\view\form\Component;
use app\core\view\form\File;
use app\core\view\form\FormBuilder;
use app\core\view\form\Submit;
use app\core\view\form\Text;
use app\core\view\form\TextArea;
use ntc\component\form\field\ComponentField;
use ntc\section\form\field\SectionParent;
use ntc\shop\form\field\CurrentShop;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * SectionForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class SectionForm extends FormController
{
    use ImageUploadTrait;

    public function __construct()
    {
        $this->tmp_dir = __DIR__ . '/../../uploads/tmp';
        $this->upload_dir = __DIR__ . '/../../uploads';
        $this->tmp_dir_route = 'admin.section.image.temp.url';
        $this->image_model = SectionImage::class;
        $this->image_model_foreign_key = 'section_id';
    }

    public static function inject(ContainerInterface $container)
    {
        return new static();
    }

    public function build(Formbuilder $builder)
    {

        $builder->add('current_shop', CurrentShop::class);
        $builder->add('name', Text::class);
        $builder->add('parent_id', SectionParent::class, function ($parent_id) {
            $parent_id->label = "parent";
        });
        $builder->add('images', File::class, function ($images) {
            $images->uploadUrl = "http://localhost/application/admin/section/image/upload";
            $images->deleteUrl = "http://localhost/application/admin/section/image/delete/";
        });
        $builder->add('url', Text::class);
        $builder->add('description', TextArea::class);
        $builder->add('components', ComponentField::class, function ($component) {
            $component->target = 'ntc\section';
        });

        $builder->add('submit', Submit::class);
        return $builder;
    }

    public function createEntity(Request $request)
    {
        $section = Section::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'url' => $request->url,
            'description' => $request->description,
            'shop_id' => $request->current_shop
        ]);

        $dir = $this->upload_dir . '/' . $section->id;
        is_dir($dir) ?: mkdir($dir);
        foreach ((array)$request->image as $id => $name) {
            $from = realpath($this->tmp_dir . '/' . $name);
            $to = $dir . '/' . $name;
            if (rename($from, $to)) {
                SectionImage::where('id', $id)->update([
                    'path' => $this->generateUrl('admin.section.image.url', ['id' => $section->id, 'name' => $name]),
                    'section_id' => $section->id
                ]);
            }
        }
        return true;
    }

    protected function updateEntity(Request $request, $id)
    {


    }

}
