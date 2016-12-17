<?php

namespace app\core\template;

use app\core\template\TemplateEngineInterface;

/**
 * Description of SmartyTemplateEngine
 *
 * @author Tobi
 */
class SmartyTemplateEngine extends \Smarty implements TemplateEngineInterface {

    public function __construct() {
        parent::__construct();
    }

}
