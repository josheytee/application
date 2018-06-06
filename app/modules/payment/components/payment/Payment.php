<?php

namespace ntc\payment\payment;

use app\core\component\Component;

class Payment extends Component
{

    public function render()
    {
        return $this->display('ntc\payment\payment');
    }
}