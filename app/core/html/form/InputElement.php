<?php

namespace app\core\html\form;

use app\core\html\form\FormElement;

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
      $this->addAtribute('placeholder', ucwords($this->name));
    }
    $this->normalize();
//    $attributes = $this->processArray(
//                    ['name' => $this->name,
//                        'id' => $this->id])
//            . $this->processAttribute();
    return['value' => $this->value, 'attributes' => $this->processAttribute()];
  }

}
