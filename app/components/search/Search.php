<?php

namespace ntc\search;

use app\core\component\Component;

class Search extends Component {

  public function render() {
    $template = $this->getTemplate();
    return $this->display('ntc_search');
  }

}
