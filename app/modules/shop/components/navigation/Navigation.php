<?php

namespace ntc\shop\navigation;

use app\core\component\Component;

class Navigation extends Component {

  public function render() {
    return $this->display('ntc/shop/navigation');
  }

}
