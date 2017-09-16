<?php

namespace ntc\logo;

use app\core\component\Component;

class Logo extends Component {


    public function render() {
        $template = $this->getTemplate(__DIR__, 'logo.tpl');
        return $this->display('logo.tpl',['shop_name'=>'New Shop','shop_description'=>'SHOP ANYWHERE']);
    }


}
