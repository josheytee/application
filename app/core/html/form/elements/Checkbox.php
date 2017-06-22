<?php

namespace app\core\html\form\elements;

use app\core\html\form\InputElement;

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
