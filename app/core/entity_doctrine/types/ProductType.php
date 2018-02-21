<?php

namespace app\core\entity_doctrine\types;


/**
 * Description of ProductCondition
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProductType extends EnumType
{

    protected $name = 'product_type';
    protected $values = ['simple', 'pack', 'virtual'];

}
