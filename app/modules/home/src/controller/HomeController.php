<?php

namespace ntc\home\controller;

use app\core\controller\ControllerBase;

/**
 * Description of HomeController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class HomeController extends ControllerBase {

  public function index() {
    $template = $this->getTemplate(__DIR__, 'home.tpl');
    return $this->render($template);
  }

}
