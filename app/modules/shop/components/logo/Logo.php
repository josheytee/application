<?php

namespace ntc\shop\logo;

use app\core\component\Component;

class Logo extends Component {

    public function render() {
        return $this->display('ntc/shop/logo', ['shop_name' => 'New Shop', 'shop_description' => 'SHOP ANYWHERE']);
    }


}
