<?php

namespace ntc\cart;

use app\core\component\Component;

class Cart extends Component {

  public function render() {
    return $this->display('ntc_cart');
  }

}
