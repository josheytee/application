<?php

namespace app\core\access;

use app\core\http\Request;


/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
interface AccessCheckerInterface
{
    public function check(Request $request, $account);
}
