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
        $this->initSmarty();
    }

    public function initSmarty() {
        $this->setCompileDir('./app/cache/smarty/compile/');
        $this->setConfigDir(__DIR__ . \DIRECTORY_SEPARATOR . 'config');
        $this->setCacheDir('./app/cache/smarty/cache/');
        $this->setTemplateDir($this->findTemplateDir());
        $this->debugging = TRUE;
    }

    public function findTemplateDir() {
        return "";
    }

    public function fetch($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL) {
        try {
            return parent::fetch($template, $cache_id, $compile_id, $parent);
        } catch (\Exception $e) {
            $e->getTraceAsString();
        }
    }

    public function display($template = null, $cache_id = null, $compile_id = null, $parent = null) {
        try {
            return parent::display($template, $cache_id, $compile_id, $parent);
        } catch (\Exception $e) {
            $e->getTraceAsString();
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
    public function createAndFetch($template, $data = null, $cache_id = null, $compile_id = null, $parent = null) {
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
    public function createAndDisplay($template, $data = null, $cache_id = null, $compile_id = null, $parent = null) {
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

}
