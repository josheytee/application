<?php

namespace ntc\administrator\notification;

use app\core\component\Component;
use app\core\http\Request;

/**
 * Description of Top
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Notification extends Component
{

    public function render(Request $request)
    {
        return $this->display('ntc/administrator/notification');
    }

}
