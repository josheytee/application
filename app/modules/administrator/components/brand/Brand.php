<?php

namespace ntc\administrator\brand;

use app\core\component\Component;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Brand extends Component {

  public static function inject(ContainerInterface $container) {
    parent::inject($container);
  }

  public function render() {
    $template = $this->getTemplate(__DIR__, 'brand.tpl');
    return $this->show($template);
  }

}
