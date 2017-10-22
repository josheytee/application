<?php

namespace app\core\view;

use app\core\Context;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait RenderableTrait
{

    public function renderTrait($data = null, $tpl = null)
    {
        $activeTheme = Context::themeManager()->getActiveTheme();
        $templateEngine = Context::{$activeTheme->getEngine()}();
        $template = $activeTheme->getTemplate($tpl);
        return $templateEngine->createAndFetch($template, $data);
    }

    public function templateExist($template)
    {
        return file_exists(Context::themeManager()->getActiveTheme()->getTemplate($template));
    }

    public function renderCustomTrait($tpl, $data = null, $engine = 'smarty')
    {
        $templateEngine = Context::$engine();
        return $templateEngine->createAndFetch($tpl, $data);
    }
}
