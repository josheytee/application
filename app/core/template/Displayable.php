<?php

namespace app\core\template;

use app\core\theme\ThemeManager;
use app\core\Context;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait Displayable {

    public function display($content = null, $tpl = null) {
        $this->theme_manager = new ThemeManager();
        $smarty = Context::smarty();
        foreach ($this->theme_manager->getActiveTheme() as $path) {
            $s = $path . DS . 'template' . DS . $tpl;
            $tpl = $smarty->createAndFetch($s, $content);
        }
        return $tpl;
    }

}
