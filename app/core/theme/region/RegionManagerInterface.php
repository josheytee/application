<?php

namespace app\core\theme\region;

use app\core\http\Request;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface RegionManagerInterface
{

    public function getContent(Request $request, $region);
}
