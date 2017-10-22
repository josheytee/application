<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 * form hidden input
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Hidden extends InputElement
{

    public function __construct($name, $value = null, $attributes = null)
    {
        parent::__construct($name, $value, $attributes);
        $this->addAttribute('type', 'hidden');
    }

}
