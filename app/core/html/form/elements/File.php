<?php

namespace app\core\html\form\elements;

use app\core\html\form\InputElement;

/**
 * Description of File
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class File extends InputElement {

  public function __construct($name, $value = null, $attributes = []) {
    parent::__construct($name, $value, $attributes);
    $this->addAtribute('type', 'file');
  }

}
