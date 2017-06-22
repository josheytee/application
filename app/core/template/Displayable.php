<?php

namespace app\core\template;

use app\core\Context;
use app\core\http\Response;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait Displayable {

  public function display($content = null, $tpl = null) {
    $this->theme_manager = Context::themeManager();
    $smarty = Context::smarty();
    foreach ($this->theme_manager->getActiveTheme() as $path) {
      $template = $path . DS . 'templates' . DS . $tpl;
      $tpl = $smarty->createAndFetch($template, $content);
    }
    return new Response($tpl);
  }

}
