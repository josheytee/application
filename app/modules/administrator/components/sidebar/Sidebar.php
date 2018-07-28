<?php

namespace ntc\administrator\sidebar;

use app\core\component\Component;
use app\core\http\Request;

/**
 *
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Sidebar extends Component
{

   public function render(Request $request)
    {
        $this->setDefaultTemplate(__DIR__ . '/templates/sidebar.tpl');
        return $this->display('ntc/administrator/sidebar');
    }

}
