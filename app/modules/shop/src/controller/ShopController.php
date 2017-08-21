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

  public function __construct(EntityManager $entityManager) {

    $this->entity_manager = $entityManager;
  }

  public static function inject(ContainerInterface $container) {
    return new static($container->get('entity.manager'));
  }

  public function add(Request $request) {
    $manager = $this->entity_manager->getRepository('model\Shop')->find(1);

    return $this->render($this->getTemplate(__DIR__, 'form.tpl')
                    , ['shop' => $manager]
    );
  }

}
