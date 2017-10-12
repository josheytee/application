<?php

namespace ntc\shop\featured;


use app\core\component\Component;

class Featured extends Component {

    public function render() {
        return $this->display('ntc/shop/featured');
    }
}