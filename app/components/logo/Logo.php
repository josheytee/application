<?php

namespace ntc\logo;

use app\core\component\Component;

class Logo extends Component {


    public function render() {
        $template = $this->getTemplate();
        return $this->display('ntc_logo',['shop_name'=>'New Shop','shop_description'=>'SHOP ANYWHERE']);
    }


}
