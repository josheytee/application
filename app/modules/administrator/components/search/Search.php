<?php

use app\core\component\Component;

class Search extends Component {

    function __construct() {

    }

    public function render() {
        $template = $this->getTemplate(__DIR__, 'search.tpl');
        return $this->show($template);
    }

}
