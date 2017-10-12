<?php

namespace ntc\administrator\search;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Search extends Component {

    public static function inject(ContainerInterface $container) {
        parent::inject($container);
    }

    public function render() {
        $this->setDefaultTemplate(__DIR__ . '/templates/search.tpl');
        return $this->display('ntc/administrator/search');
    }

}
