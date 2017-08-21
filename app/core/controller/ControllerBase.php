<?php

namespace app\core\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\dependencyInjection\ContainerInjectionInterface;
use app\core\Context;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use app\core\view\Renderabletrait;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

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

  public function renderTemplate($template, $data = null) {
    $smarty = $this->smarty();
    $tpl = $smarty->createAndFetch($template, $data);
    return ($tpl);
  }

  public function addLibrary($name) {

  }

  public function render($template, $content = '') {
    $return = [];
    $return['libraries'] = '';
    $return['content'] = $this->renderTemplate($template, $content);
    return $return;
  }

}
