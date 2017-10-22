<?php

namespace ntc\section\form;

use app\core\controller\FormController;
use app\core\view\form\Formbuilder;

class SectionImageForm extends FormController
{

    public function build(Formbuilder $builder, $entity)
    {
        $builder->file('file[]');
        $builder->file('file[]');
        $builder->submit('upload');
        return $builder;
    }

    public function validationRules()
    {

    }

    public function attributes()
    {
        return ['enctype' => 'multipart/form-data'];
    }
    ///var/www/html/application/extensions/modules/ntc/section/1/imgs

}
