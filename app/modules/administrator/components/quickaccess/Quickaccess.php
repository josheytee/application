<?php

namespace ntc\administrator\quickaccess;

use app\core\component\Component;

/**
 * Description of QuickAccess
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Quickaccess extends Component
{

    public function render()
    {
        return $this->display('ntc/administrator/quickaccess');
    }

}
