<?php

namespace ntc\administrator\notification;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of Top
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Notification extends Component {

  public static function inject(ContainerInterface $container) {
    parent::inject($container);
  }

  public function render() {
    $template = $this->getTemplate();
    return $this->display('ntc_administrator_notification');
  }

}
