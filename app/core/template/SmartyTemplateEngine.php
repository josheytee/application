<?php

namespace app\core\template;

/**
 * Description of SmartyTemplateEngine
 *
 * @author Tobi
 */
class SmartyTemplateEngine extends \Smarty implements TemplateEngineInterface
{

    public function __construct()
    {
        parent::__construct();
        $this->configure();
    }

    public function configure()
    {
        $this->setCompileDir('/var/smarty/compile/');
        $this->setConfigDir(__DIR__ . \DIRECTORY_SEPARATOR . 'config');
        $this->setCacheDir('/var/smarty/cache/');
        $this->addPluginsDir('/var/www/html/application/app/core/template/smarty/plugin');
        $this->debugging = TRUE;
    }

    public function init()
    {
        $this->registerPlugin('modifier', 'exists', array(&$this, 'variableExists'));
    }

    public function variableExists($param = '')
    {
        var_dump($param);
        return is_null($param) ? new \Smarty_Variable('$param') : $param;
    }

    public function fetch($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL)
    {
        try {
            return parent::fetch($template, $cache_id, $compile_id, $parent);
        } catch (\Exception $e) {
            echo "<br/>" . $e->getTraceAsString();
        }
    }

    public function display($template = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        try {
            return parent::display($template, $cache_id, $compile_id, $parent);
        } catch (\Exception $e) {
            echo "<br/>" . $e->getTraceAsString();
        }
    }

    /**
     * Not only is this function a shortcut for creating Template.
     * It also catches the exception its always breaks code
     *
     * @param type $template
     * @param type $data
     * @param type $cache_id
     * @param type $compile_id
     * @param type $parent
     * @return type
     */
    public function createAndDisplay($template, $data = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        $tpl = $this->createTemplate($template, $cache_id, $compile_id, $parent);
        if (isset($data)) {
            $tpl->assign($data);
        }
        try {
            return $tpl->display($template, $cache_id, $compile_id, $parent);
        } catch (\Exception $e) {
            echo "<br/>" . $e->getMessage();
        }
    }

    public function makeTemplate($template, $params = array())
    {
        $cache_id = $params['cache_id'] ?? null;
        $compile_id = $params['compile_id'] ?? null;
        $parent = $params['parent'] ?? null;
        $do_clone = $params['do_clone'] ?? null;
        return $this->createTemplate($template, $cache_id, $compile_id, $parent, $do_clone);
    }

    public function output($template, $data = null)
    {
        return $this->createAndFetch($template, $data);
    }

    /**
     * Not only is this function a shortcut for creating Template.
     * It also catches the exception its always breaks code
     *
     * @param type $template
     * @param type $data
     * @param type $cache_id
     * @param type $compile_id
     * @param type $parent
     * @return type
     */
    public function createAndFetch($template, $data = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        $tpl = $this->createTemplate($template, $cache_id, $compile_id, $parent);
        if (isset($data)) {
            $tpl->assign($data);
        }
        try {
            return $tpl->fetch($template, $cache_id, $compile_id, $parent);
        } catch (\Exception $e) {
            echo "<br/>" . $e->getMessage();
        }
    }

}
