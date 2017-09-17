<?php

namespace ntc\navigation;

use app\core\component\Component;

class Navigation extends Component {

  public function render() {
    $template = $this->getTemplate();
    return $this->display('ntc_navigation.tpl');
  }

}
