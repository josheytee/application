<?php

namespace ntc\product\single;

use app\core\component\Component;

class Single extends Component {

    public function render() {
        return $this->display('ntc/product/single');
    }

}