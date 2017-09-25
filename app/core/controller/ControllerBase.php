<?php

namespace app\core\controller;

use app\core\dependencyInjection\ContainerInjectionInterface;
use app\core\http\Request;
use app\core\view\Renderabletrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;

/**
 * Description of Controller
 *
 * @author adapter
 */
abstract class ControllerBase implements ContainerInjectionInterface, ContainerAwareInterface {

    use Renderabletrait;
    use ContainerAwareTrait;
    use ControllerTrait;

    public static function inject(ContainerInterface $container) {
        return new static();
    }

    public function l($param0) {
        return $param0;
    }

    public function getModel(Request $request) {
        return $request->get('_model');
    }

    abstract function title();

    function getDependencies() {
    }


    public function getTemplate($dir, $file = null) {
        $template_dir = dirname(dirname($dir)) . DS . 'templates';
        $finder = new Finder();
        $finder->files()->in($template_dir);
        foreach ($finder as $dir) {
//            echo $dir->getFileName() . "<br/>";
//            echo $dir->getPathName() . "<br/> -----------<br/>";
            if ($file == $dir->getFileName() && file_exists($dir->getPathName())) {
//                dump($dir->getPathName());
                return $dir->getPathName();
            }
        }
    }

    public function renderTemplate($template, $data = null) {
        $smarty = $this->smarty();
        $tpl = $smarty->createAndFetch($template, $data);
        return ($tpl);
    }

    public function addLibrary($name) {

    }

    public function renderCustom($template, $content = '') {
        $return = [];
        $return['libraries'] = '';
        $return['content'] = $this->renderTemplate($template, $content);
        return $return;
    }

    public function render($template, $content = '') {
        $return = [];
        $return['libraries'] = '';
        $return['content'] = $this->rendertrait($content, $template);
        return $return;
    }

}
