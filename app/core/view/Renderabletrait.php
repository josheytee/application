<?php

namespace app\core\view;

use app\core\Context;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait Renderabletrait {

  public function rendertrait($content = null, $tpl = null) {
    $this->theme_manager = Context::themeManager();
    $smarty = Context::smarty();
    $active = $this->theme_manager->getActiveTheme();
    $template = $active->getTemplate($tpl);
    $tpl = $smarty->createAndFetch($template, $content);
    return $tpl;
  }

}
