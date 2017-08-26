<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 * Form Tel input
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Tel extends InputElement {

  public function __construct($name, $value = null, $attributes = null) {
    parent::__construct($name, $value, $attributes);
    $this->addAttribute('type', 'tel');
  }

}
