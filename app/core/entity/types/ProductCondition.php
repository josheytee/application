<?php

namespace app\core\entity\types;



/**
 * Description of ProductCondition
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProductCondition extends EnumType {

    protected $name = 'product_condition';
    protected $values = ['new', 'used', 'refurbished'];

}
