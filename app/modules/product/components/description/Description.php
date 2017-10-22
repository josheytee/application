<?php

namespace ntc\product\description;

use app\core\component\Component;

class Description extends Component
{

    public function render()
    {
        return $this->display('ntc/product/description');
    }

}