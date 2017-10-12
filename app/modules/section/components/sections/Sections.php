<?php

namespace ntc\section\sections;

use app\core\component\Component;

class Sections extends Component {

    public function render() {
        return $this->display('ntc/section/sections');
    }

}