<?php

namespace ntc\administrator\search;

use app\core\component\Component;
use app\core\http\Request;

/**
 *
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Search extends Component
{

   public function render(Request $request)
    {
        $this->setDefaultTemplate(__DIR__ . '/templates/search.tpl');
        return $this->display('ntc/administrator/search');
    }

}
