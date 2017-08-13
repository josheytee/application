<?php

namespace app\core\view\form\elements;

use app\core\view\form\InputElement;

/**
 * Form Email input
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Email extends InputElement {

  public function __construct($name, $value = null, $attributes = null) {
    parent::__construct($name, $value, $attributes);
    $this->addAttribute('type', 'email');
  }

}
