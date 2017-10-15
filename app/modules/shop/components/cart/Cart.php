<?php

namespace ntc\shop\cart;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Cart extends Component {

  public function render() {
    return $this->display('ntc/shop/cart');
  }

}
