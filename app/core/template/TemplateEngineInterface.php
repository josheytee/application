<?php

namespace app\core\template;

/**
 * Description of TemplateEngine
 *
 * @author Tobi
 */
interface TemplateEngineInterface
{

    public function configure();

    public function fetch($template = NULL, $params = array());

    public function display($template = NULL, $params = array());

    public function output($template, $data = null);

    public function makeTemplate($template, $params = array());
}
