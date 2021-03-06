<?php

namespace app\core\service;

use app\core\template\SmartyTemplateEngine;
use app\core\template\TemplateEngineInterface;

/**
 * Description of TemplateManagementService
 * create template engine system
 * uses smarty as its default
 * @author Tobi
 */
class TemplateManagementService extends KernelService
{

    public $templateEngine;

    public function __construct()
    {
        $this->setTemplateEngine(new SmartyTemplateEngine);
    }

    public function setTemplateEngine(TemplateEngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public static function subscribe($object = null)
    {
        parent::subscribe($object);
        return new SmartyTemplateEngine();
    }

    public static function start()
    {
        parent::start();
    }

    public function __call($method, $args)
    {
        $this->templateEngine->$method($args[0]);
    }

}
