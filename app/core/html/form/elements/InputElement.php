<?php

namespace app\core\html\form\elements;

/**
 * Description of InputElement
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class InputElement {

  protected $name;
  protected $class = [];
  protected $id;
  protected $value;
  // theis should always be a key value pair
  protected $attribute = [];

  function getClass() {
    return $this->class;
  }

  function getAttributes() {
    return $this->attribute;
  }

  function addClass($class) {
    $this->class[] = $class;
    return $this;
  }

  function addAtribute($attribute) {
    $this->attribute[] = $attribute;
    return $this;
  }

  public function processAttribute() {
    return $this->processArray($this->getAttributes());
  }

  public function processArray($ele) {
    return implode(',', $ele);
  }

  public function compact() {
    return [
        'name' => $this->name,
        'class' => $this->processArray($this->class),
        'id' => $this->id,
        'value' => $this->value,
        $this->processAttribute()
    ];
  }

}
