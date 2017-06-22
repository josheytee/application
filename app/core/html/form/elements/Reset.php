<?php

namespace app\core\html\form\elements;

use app\core\html\form\InputElement;

/**
 * Description of Reset
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Reset extends InputElement {

  public function __construct($name, $value = null, $attribute = null) {
    parent::__construct($name, $value, $attribute);
    $this->addAtribute('type', 'reset');
  }

}
