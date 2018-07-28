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
    public function render(Request $request)
    {
$user=$this->currentUser();
        return $this->display('ntc/administrator/userinfo', [
            'name' =>$user ->getAccountName(),
            'picture' => $user->getPicture(),
            'role' => 'super admin'
        ]);
    }

}
