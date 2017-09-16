<?php

namespace ntc\hotline;

use app\core\component\Component;

class Hotline extends Component {

  public function render() {
    return $this->display('ntc_hotline.tpl');
  }

}
