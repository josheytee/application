<?php

namespace app\core\view\form\elements;

use app\core\view\form\FormElement;

/**
 * Description of Label
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Label extends FormElement {

  protected $template = 'label.tpl';
  protected $for;

  public function __construct($for, $value = '', $attribute = null) {
    $this->for = $for;
    parent::__construct($for, ucwords($value), $attribute);
    $this->addAttribute('for', $this->for);
  }

  public function initialize() {
    if (empty($this->value)) {
      $this->value = $this->toCamelCase($this->for, true);
    }
    //used by form build to remove element after added to a block
    $this->name = md5($this->for);
  }

  public function compact() {
    $this->initialize();
    return [
        'attributes' => $this->processAttribute(),
        'value' => $this->value
    ];
  }

}
