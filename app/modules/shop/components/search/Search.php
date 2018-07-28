<?php

namespace ntc\shop\search;

use app\core\component\Component;
use app\core\http\Request;

class Search extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/shop/search');
    }

}
