<?php

namespace app\core\view\form\elements;

use app\core\view\form\FormElement;

/**
 * Help block handling in form
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Help extends FormElement
{
    protected $template = 'help';

    public function __construct($name, $value = null, $attribute = null)
    {
        parent::__construct($name, $value, $attribute);
        $this->addAttribute('class', 'help-block');
    }

    /**
     * @return array usable for its template file
     */
    public function compact()
    {
        return ['value' => $this->value, 'attributes' => $this->processAttribute()];
    }
}
