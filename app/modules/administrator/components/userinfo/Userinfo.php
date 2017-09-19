<?php

namespace ntc\administrator\userinfo;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of UserInfo
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Userinfo extends Component {

    public static function inject(ContainerInterface $container) {
        parent::inject($container);
    }

    public function render() {
        $template = $this->getTemplate('userinfo.tpl');
        return $this->display('ntc_administrator_userinfo.tpl');
    }

}
