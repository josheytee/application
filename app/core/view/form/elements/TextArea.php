<?php

namespace app\core\view\form\elements;

use app\core\view\form\FormElement;


/**
 * Description of Select
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class TextArea extends FormElement
{

    protected $template = 'textarea';

    public function __construct($name, $value = null, $attribute = null)
    {
        parent::__construct($name, $value, $attribute);
//        $this->addAttribute('class', 'help-block');
    }

    /**
     * @return array usable for its template file
     */
    public function compact()
    {
        return ['value' => $this->value, 'attributes' => $this->processAttribute()];
    }

}
