<?php

namespace ntc\block\subscriber;

use app\core\theme\ThemeManager;
use ntc\block\BlockManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Description of LayoutFilterSubscriber
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class LayoutFilterSubscriber implements EventSubscriberInterface
{

    /**
     * @var ThemeManager
     */
    private $theme_manager;

    public function __construct(ThemeManager $themeManager)
    {

        $this->theme_manager = $themeManager;
    }

    public static function getSubscribedEvents(): array
    {
        return ['kernel.response' => 'process'];
    }

    public function process(FilterResponseEvent $event)
    {
//    dump($event->getRequest());
        $block = new BlockManager($event->getRequest(), $this->theme_manager);
        $block->setContainerContent($event->getResponse());
        $event->setResponse($block->render());
    }

}
