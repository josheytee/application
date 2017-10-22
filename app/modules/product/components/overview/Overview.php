<?php

namespace ntc\product\overview;

use app\core\component\Component;

class Overview extends Component
{

    public function render()
    {
        return $this->display('ntc/product/overview');
    }

}