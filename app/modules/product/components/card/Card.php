<?php

namespace ntc\product\card;

use app\core\component\Component;
use app\core\http\Request;

class Card extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/product/card');
    }

    public function renderWithParams($params)
    {
        return $this->display('ntc/product/card', $params);
    }
}