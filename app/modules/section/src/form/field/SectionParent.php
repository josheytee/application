<?php

namespace ntc\section\form\field;

use app\core\entity\Section;
use app\core\view\form\FormChildren;

class SectionParent extends FormChildren
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->defaultValue = 1;
        $this->setCustomTemplate(__DIR__ . '/../../../templates/field/sectionparent.tpl');
    }

    public function getSections()
    {
        return Section::all();
    }

    public function assign()
    {
        return parent::assign() + ['sections' => $this->getSections()];
    }
}