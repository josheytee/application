<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 * Description of Text
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Checkbox extends InputElement {

  public function __construct($name, $value = [], $attributes = null) {
    parent::__construct($name, $value, $attributes);
    $this->addAtribute('type', 'checkbox');
  }

}
