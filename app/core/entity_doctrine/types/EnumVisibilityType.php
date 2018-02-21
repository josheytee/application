<?php

namespace app\core\entity_doctrine\types;

class EnumVisibilityType extends EnumType
{

    protected $name = 'enumvisibility';
    protected $values = array('visible', 'invisible');

}
