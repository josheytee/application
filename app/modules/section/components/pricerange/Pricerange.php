<?php

namespace ntc\section\priceRange;

use app\core\component\Component;
use app\core\http\Request;

class Pricerange extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/section/pricerange');
    }

}