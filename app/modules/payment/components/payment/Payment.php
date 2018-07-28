<?php

namespace ntc\payment\payment;

use app\core\component\Component;
use app\core\http\Request;

class Payment extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc\payment\payment');
    }
}