<?php

namespace ntc\shop\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\http\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of ShopController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ShopController extends ControllerBase {

    /**
     * @var EntityManager
     */
    private $entity_manager;
    /**
     * @var ComponentManager
     */
    private $componentManager;

    public function __construct(ComponentManager $componentManager) {
        $this->componentManager = $componentManager;
    }

    public static function inject(ContainerInterface $container) {
        return new static($container->get('component.manager'));
    }

    public function index(Request $request) {
        $manager = $this->doctrine()->getRepository(\app\core\entity\Shop::class)->find(1);
//        dump($manager);
        $shop_components = $this->componentManager->getTargetComponents('shop');
        return $this->render('shop/ntc_shop', ['components' => $shop_components]);
    }

    public function home(Request $request) {
        dump($this->componentManager->getTargetComponents('shop'));
    }

}
