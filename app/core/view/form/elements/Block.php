<?php

namespace app\core\view\form\elements;

use app\core\view\form\FormElement;

/**
 * Description of Block
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Block extends FormElement {

  protected $elements;
  protected $template = 'block.tpl';

  public function __construct($name, $attributes = []) {
    parent::__construct($name, null, $attributes);
  }

  public function compact() {
//    $this->normalize();
    return [
        'attributes' => $this->processAttribute(),
        'elements' => $this->elements
    ];
  }

  public function addElements($elements) {
    foreach ($elements as $element) {
      if (is_array($element)) {
        foreach ($element as $elem) {
          $this->elements[] = $elem->render();
        }
      } else {

        $this->elements[] = $element->render();
      }
    }
    return $this;
  }

}