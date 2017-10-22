<?php

namespace app\core\view\form\elements;

//use app\core\view\form\elements\OptionGroup;

/**
 * Description of Option
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Option
{

    public $slug;
    public $value;
    public $disabled;
    public $selected;
    //put here to aviod template notice
    public $type;

    public function __construct($slug, $value, $selected = false, $disabled = false)
    {
        $this->slug = $slug;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->selected = $selected;
    }

    public function __toString()
    {
        return $this->slug;
    }

}
