<?php

namespace ntc\slider;

use app\core\component\Component;

class Slider extends Component {

  public function render() {
    return $this->display('ntc_slider.tpl');
  }

}
