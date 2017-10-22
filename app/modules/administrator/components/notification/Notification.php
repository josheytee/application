<?php

namespace ntc\administrator\notification;

use app\core\component\Component;

/**
 * Description of Top
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Notification extends Component
{

    public function render()
    {
        return $this->display('ntc/administrator/notification');
    }

}
