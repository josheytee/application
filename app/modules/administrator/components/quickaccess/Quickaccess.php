<?php

namespace ntc\administrator\quickaccess;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of QuickAccess
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Quickaccess extends Component {

    public static function inject(ContainerInterface $container) {
        parent::inject($container);
    }

    public function render() {
        $template = $this->getTemplate(__DIR__, 'quickaccess.tpl');
        return $this->show($template);
    }

}