<?php

namespace ntc\shop\trends;
use app\core\component\Component;

class Trends extends Component{

    public function render() {
        return $this->display('ntc/shop/trends');
    }
}