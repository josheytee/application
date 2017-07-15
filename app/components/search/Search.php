<?php

namespace ntc\search;

use app\core\component\Component;

class Search extends Component {

  public function render() {
    $template = $this->getTemplate(__DIR__, 'search.tpl');
    return $this->show($template);
  }

}
