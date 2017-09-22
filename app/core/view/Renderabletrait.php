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
        $active = $this->theme_manager->getActiveTheme();
        $engine = $active->getEngine();
        $templateEngine = Context::{$engine}();
        $template = $active->getTemplate($tpl);
        $tpl = $templateEngine->createAndFetch($template, $content);
        return $tpl;
    }

}
