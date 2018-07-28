<?php

namespace ntc\carrier\shipping;

use app\core\component\Component;
use app\core\entity\Carrier;
use app\core\http\Request;

class Shipping extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc\carrier\shipping',[
            'carriers'=>Carrier::all()
        ]);
    }
}