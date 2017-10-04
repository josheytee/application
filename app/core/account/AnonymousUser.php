<?php

namespace app\core\account;

use app\core\entity\User;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AnonymousUser extends UserAccount {

    public function __construct() {
        $this->user = new User();

    }

}
