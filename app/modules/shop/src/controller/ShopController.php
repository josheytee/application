<?php

namespace ntc\shop\controller;

use app\core\controller\ControllerBase;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

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

    public function add(Request $request) {
        $manager = $this->entity_manager->getRepository('model\Shop')->find(1);

        return $this->render($this->getTemplate(__DIR__, 'form.tpl')
                        , ['shop' => $manager]
        );
    }

    public function index(Request $request) {
        $manager = $this->doctrine()->getRepository(\app\core\entity\Shop::class)->find(1);
//        dump($manager);
        return $this->render('shop/index.tpl'
                        , ['shop' => $manager]
        );
    }

}
