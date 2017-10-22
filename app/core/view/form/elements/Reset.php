<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 * Description of Reset
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Reset extends InputElement
{

    public function __construct($name, $value = null, $attribute = null)
    {
        parent::__construct($name, $value, $attribute);
        $this->addAttribute('type', 'reset');
    }

}
