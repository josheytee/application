<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Radio extends InputElement {

    public function __construct($name, $value = null, $attributes = null) {
        parent::__construct($name, $value, $attributes);
        $this->addAttribute('type', 'radio');
        $this->template = 'radio_check';
    }

    public function compact() {

        if (!isset($this->id)) {
            $this->id = lcfirst($this->name);
        }
        if (!array_key_exists('placehoder', $this->getAttributes())) {
            $this->addAttribute('placeholder', $this->toCamelCase($this->name));
        }
        $this->normalize();
        return ['value' => $this->value, 'attributes' => $this->processAttribute()];
    }
}
