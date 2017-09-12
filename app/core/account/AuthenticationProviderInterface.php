<?php

namespace app\core\account;

use app\core\http\Request;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
interface AuthenticationProviderInterface {

    public function applies(Request $request);

    public function authenticate(Request $request);
}
