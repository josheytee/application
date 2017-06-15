<?php

namespace app\core\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\dependencyInjection\ContainerInjectionInterface;
use app\core\Context;
use Symfony\Component\Finder\Finder;
use app\core\http\Response;

/**
 * Description of Controller
 *
 * @author adapter
 */
abstract class ControllerBase implements ContainerInjectionInterface {

  use \app\core\template\Displayable;

  protected $view_manager;

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
//      else {
//        echo "<br/> invalid template: " . $file;
//      }
    }
  }

  public function redirect($url) {
    return;
  }

  public function render($template, $data = null) {
    $smarty = Context::smarty();
    $tpl = $smarty->createAndFetch($template, $data);
    return new Response($tpl);
  }

//  public function render($template, $data = null) {
//    $this->view_manager = $this->getContainer()->get('view.manager');
//    var_dump($this->view_manager->render($template, $data));
//  }
}
