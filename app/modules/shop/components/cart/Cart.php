<?php

namespace ntc\shop\cart;

use app\core\component\Component;

class Cart extends Component {

  public function render() {
    return $this->display('ntc/shop/cart');
  }

}
