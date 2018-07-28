<?php

namespace ntc\account\address;

use app\core\component\Component;
use app\core\entity\User;
use app\core\http\Request;

class Address extends Component
{

    public function render(Request $request)
    {
        $user = User::find($this->currentUser()->id());
        return $this->display('ntc/account/address', [
                'addresses' => $user->addresses()->get(),
                'user' => $user
            ]
        );
    }

}
