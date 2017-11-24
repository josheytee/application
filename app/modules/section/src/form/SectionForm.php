<?php

namespace ntc\section\form;

use app\core\controller\FormController;
use app\core\entity\{
    Section, Shop
};
use app\core\http\UploadedFile;
use app\core\view\form\FormBuilder;
use Illuminate\Support\Str;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * SectionForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class SectionForm extends FormController
{

    public static function inject(ContainerInterface $container)
    {
        return new static();
    }


    public function build(Formbuilder $builder, $entity = 0)
    {
        $builder->hidden('shop', $this->currentShop(), $entity->getShop());

        $builder->block(
            $builder->label('title')
            , $builder->text('title', $entity->getTitle())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);


        $builder->block(
            $builder->label('parent')
            , $builder->select('parent', $this->getSections(), $entity->getParent()->getId())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('file')
            , $builder->file('file')->addAttributes(['class' => 'form-control'])
        );

        $builder->block(
            $builder->label('url')
            , $builder->text('url', $entity->getUrl())->addAttributes(['class' => 'form-control'])
            , $builder->help('eg. /example')
        );
        $builder->block(
            $builder->label('description')
            , $builder->textArea('description', $entity->getDescription())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block($builder->submit('Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);
        return $builder;
    }

    public function currentShop()
    {
        return 1;
    }

    public function getSections()
    {
        $doctrine = $this->doctrine();
        $sections = $doctrine->getRepository(Section::class)->getShopSections($this->currentShop(), true);
//        dump($sections);
        return $sections;
    }

    public function formID()
    {
        return 'user';
    }

    public function getDependencies()
    {
        return [
            'parent' => Section::class,
            'shop' => Shop::class
        ];
    }

    function title()
    {
        return 'section';
    }

    public function attributes()
    {
        return ['enctype' => 'multipart/form-data'];
    }

    public function handleFile($entity, UploadedFile $file)
    {
//        /var/www/html/application/extensions/modules/ntc/section/1/imgs
        dump($file);
        $name = time() . Str::studly($file->getClientOriginalName());
        dump($name);
        dump(is_dir('/application/extensions/modules/ntc/section/1/images/'));
        $file->move('C:\wamp\www\application\extensions\modules\ntc\section\1\images\\', $name);
    }

    public function validationRules()
    {
        return [
            'title' => 'required'
        ];
    }

}
