<?php

namespace app\core\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\dependencyInjection\ContainerInjectionInterface;
use app\core\Context;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Description of Controller
 *
 * @author adapter
 */
abstract class ControllerBase implements ContainerInjectionInterface {

  use \app\core\view\Renderabletrait;

  public static function inject(ContainerInterface $container) {
    return new static();
  }

  public function l($param0) {
    return $param0;
  }

  protected function getContainer() {
    return Context::getContainer();
  }

  public function getDoctrine() {
    return Context::getDoctrine();
  }

  public function getTemplate($dir, $file = null) {
    $template_dir = dirname(dirname($dir)) . DS . 'templates';
    $finder = new Finder();
    $finder->files()->in($template_dir);
    foreach ($finder as $dir) {
//      echo $dir->getFileName();
//      echo $dir->getPathName();
      if ($file == $dir->getFileName() && file_exists($dir->getPathName())) {
        return $dir->getPathName();
      }
    }
  }

  public function redirect($url) {
    return new RedirectResponse($url);
  }

  public function route($route_name, ...$params) {
    return $this->getContainer()->get('link.manager')->route($route_name, $params);
  }

  public function renderc($template, $data = null) {
    $smarty = Context::smarty();
    $tpl = $smarty->createAndFetch($template, $data);
    return ($tpl);
  }

  public function addLibrary($name) {

  }

  public function render($template, $content = '') {
    $return = [];
    $return['libraries'] = '';
    $return['content'] = $this->renderc($template, $content);
    return $return;
  }

}
