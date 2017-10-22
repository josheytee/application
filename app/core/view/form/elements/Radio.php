<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Radio extends InputElement
{

    /**
     * @var string
     */
    private $default;

    public function __construct($name, $value = null, $default = '', $attributes = null)
    {
        parent::__construct($name, $value, $attributes);
        $this->addAttribute('type', 'radio');
        $this->template = 'radio_check';
        $this->default = $default;
    }

    public function compact()
    {
        $this->normalize();
        $this->addAttribute('value', $this->value);
        if ($this->value == $this->default) {
            $this->addAttribute('checked', null);
        }
        if (!isset($this->id)) {
            $this->id = lcfirst($this->name);
        }
        return ['value' => $this->value, 'attributes' => $this->processAttribute()];
    }
}
