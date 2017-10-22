<?php

namespace ntc\administrator\userinfo;

use app\core\component\Component;

/**
 * Description of UserInfo
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Userinfo extends Component
{

    private $user;

    public function init()
    {
//    dump($this->currentUser()->getRoles());
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
