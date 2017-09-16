<?php

namespace ntc\shop\controller;

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

    public function __construct() {

    }

    public static function inject(ContainerInterface $container) {
        return new static();
    }

    public function index(Request $request) {
        $manager = $this->doctrine()->getRepository(\app\core\entity\Shop::class)->find(1);
//        dump($manager);
        return $this->render('shop/shop.tpl');
    }

}
