<?php

namespace ntc\shop\search;

use app\core\component\Component;

class Search extends Component {

  public function render() {
    return $this->display('ntc/shop/search');
  }

}
