<?php

use app\core\component\Component;

class Cart extends Component {

    public static function inject(\Symfony\Component\DependencyInjection\ContainerInterface $container) {
        parent::inject($container);
    }

    public function render() {
        $template = $this->getTemplate(__DIR__, 'cart.tpl');
        return $this->show($template);
    }

}
