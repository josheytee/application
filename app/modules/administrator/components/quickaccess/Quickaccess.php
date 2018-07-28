<?php

namespace ntc\administrator\quickaccess;

use app\core\component\Component;
use app\core\http\Request;

/**
 * Description of QuickAccess
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Quickaccess extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/administrator/quickaccess');
    }

}
