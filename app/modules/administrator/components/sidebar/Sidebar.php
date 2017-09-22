<?php

namespace ntc\administrator\sidebar;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of Sidebar
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Sidebar extends Component {

  public static function inject(ContainerInterface $container) {
    parent::inject($container);
  }

  public function render() {
    $template = $this->getTemplate();
    return $this->display('ntc_administrator_sidebar');
  }

}
