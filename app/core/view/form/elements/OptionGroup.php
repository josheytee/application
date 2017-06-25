<?php

namespace app\core\view\form\elements;

use app\core\view\form\elements\Option;

/**
 * Description of PHPClass
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class OptionGroup extends Option {

  public $options;

  public function __construct($slug, $disabled = false) {
    parent::__construct($slug, NULL, $disabled);
    $this->type = 'group';
  }

  public function addOptions(Option $options) {
    $this->options[] = $options;
  }

}
