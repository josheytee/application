<?php

namespace ntc\shop\controller;

use app\core\controller\ControllerBase;
use app\core\http\Request;
use app\core\repository\ComponentRepository;
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
     * @var ComponentRepository
     */
    private $componentRepository;

    public function __construct(ComponentRepository $componentRepository) {

        $this->componentRepository = $componentRepository;
    }

    public static function inject(ContainerInterface $container) {
        return new static($container->get('component.repository'));
    }

    public function index(Request $request) {
        $manager = $this->doctrine()->getRepository(\app\core\entity\Shop::class)->find(1);
//        dump($manager);
        dump($this->componentRepository->getTargetComponents('shop'));
        return $this->render('shop/shop.tpl');
    }

    public function home(Request $request) {
        dump($this->componentRepository->getTargetComponents('shop'));
    }

}
