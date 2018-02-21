<?php

namespace ntc\administrator\userinfo;

use app\core\component\Component;
use app\core\http\Request;

/**
 * Description of UserInfo
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Userinfo extends Component
{

    private $user;

    public function init(Request $request)
    {
//    dump($this->currentUser());
        $this->user = $this->currentUser();
    }

    public function render()
    {

        return $this->display('ntc/administrator/userinfo', [
            'name' => $this->user->getAccountName(),
            'picture' => $this->user->getPicture(),
            'role' => 'super admin'
        ]);
    }

}
