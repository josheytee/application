<?php

namespace app\core\database\types;

use app\core\database\types\EnumType;

/**
 * Description of ProductCondition
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProductCondition extends EnumType {

  protected $name = 'condition';
  protected $values = ['new', 'used', 'refurbished'];

  public function __construct() {
    $this->addType('condition', $this);
  }

}
