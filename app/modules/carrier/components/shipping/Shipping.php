<?php

namespace ntc\carrier\shipping;

use app\core\component\Component;
use app\core\entity\Carrier;

class Shipping extends Component
{

    public function render()
    {
        return $this->display('ntc\carrier\shipping',[
            'carriers'=>Carrier::all()
        ]);
    }
}