<?php

namespace ntc\section\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\entity\Section;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SectionController extends ControllerBase
{
    /**
     * @var ComponentManager
     */
    private $componentManager;

    public function __construct(ComponentManager $componentManager)
    {
        $this->componentManager = $componentManager;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('component.manager'));
    }

    public function index($url)
    {
        $manager = $this->doctrine()->getRepository(Section::class)->findOneByUrl($url);
//        dump($manager);
        $components = $this->componentManager->getTargetComponents('section');
        return $this->render('ntc/section/index', compact('components'));
    }

}