<?php

namespace app\core\controller;

use app\core\dependencyInjection\ContainerInjectionInterface;
use app\core\http\Request;
use app\core\view\RenderableTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of Controller
 *
 * @author adapter
 */
abstract class ControllerBase implements ContainerInjectionInterface, ContainerAwareInterface
{

    use RenderableTrait;
    use ContainerAwareTrait;
    use ControllerTrait;

    public static function inject(ContainerInterface $container)
    {
        return new static();
    }

    public function l($param0)
    {
        return $param0;
    }

    public function getModel(Request $request)
    {
        return $request->get('_model') ?? '';
    }

    /**
     * This is for from and list controller
     */
    public function title()
    {
    }

    public function getDependencies()
    {
    }


    public function addLibrary($name)
    {
    }

    public function renderCustom($template, $content = '')
    {
        $return = [];
        $return['libraries'] = '';
        $return['content'] = $this->renderCustomTrait($template, $content);
        return $return;
    }

    public function render($template, $content = '')
    {
        $return = [];
        $return['libraries'] = '';
        $return['content'] = $this->renderTrait($content, $template);
        return $return;
    }

}
