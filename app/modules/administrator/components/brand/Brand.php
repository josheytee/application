<?php

namespace ntc\administrator\brand;

use app\core\component\Component;
use app\core\entity\Shop;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Brand extends Component {

    public static function inject(ContainerInterface $container) {
        parent::inject($container);
    }

    public function render() {
        $shop = $this->doctrine()->find(Shop::class, 1);
//        dump($this->doctrine()->find(Shop::class, 1));
        return $this->display('ntc/administrator/brand', [
            'name' => $shop->getName(),
            'url' => $shop->getUrl()
          ]
        );
    }

}
