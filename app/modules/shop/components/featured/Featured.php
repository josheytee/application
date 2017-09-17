<?php
/**
 * Created by PhpStorm.
 * User: joshua
 * Date: 9/17/17
 * Time: 2:29 AM
 */

namespace ntc\shop\featured;


use app\core\component\Component;

class Featured extends Component {

    public function render() {
        return $this->display('ntc_shop_featured.tpl');
    }
}