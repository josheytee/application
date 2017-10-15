<?php

namespace ntc\shop\account;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Account extends Component {

  public function render() {
    return $this->display('ntc/shop/account');
  }

}
