<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 * Description of Text
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Checkbox extends InputElement {
  /**
   * @var string
   */
  private $default;

  public function __construct($name, $value = null, $default = [], $attributes = null) {
    parent::__construct($name, $value, $attributes);
    $this->addAttribute('type', 'checkbox');
    $this->template = 'radio_check';
    $this->default = $default;
  }

  public function compact() {
//    dump($this->value);
    $this->normalize();
    $this->addAttribute('value', 1);
    if ($this->default == 1) {
      $this->addAttribute('checked', null);
    }
    if (!isset($this->id)) {
      $this->id = lcfirst($this->name);
    }
    return ['value' => $this->value, 'attributes' => $this->processAttribute()];
  }
}
