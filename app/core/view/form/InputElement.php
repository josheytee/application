<?php

namespace app\core\view\form;

use app\core\view\form\FormElement;

/**
 * Description of InputElement
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class InputElement extends FormElement {

  /**
   * List of field types
   */
  const TYPE_INT = 1;
  const TYPE_BOOL = 2;
  const TYPE_STRING = 3;
  const TYPE_FLOAT = 4;
  const TYPE_DATE = 5;
  const TYPE_HTML = 6;
  const TYPE_NOTHING = 7;
  const TYPE_SQL = 8;

  protected $template = 'input.tpl';

  public function compact() {

    if (!isset($this->id)) {
      $this->id = lcfirst($this->name);
    }
    if (!array_key_exists('placehoder', $this->getAttributes())) {
      $this->addAttribute('placeholder', $this->toCamelCase($this->name));
    }
    $this->normalize();
    return['value' => $this->value, 'attributes' => $this->processAttribute()];
  }

}
