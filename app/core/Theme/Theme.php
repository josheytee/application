<?php

namespace app\core\theme;

use app\core\service\KernelService;

/**
 * Description of Template
 *
 * @author Tobi
 */
class Theme {

    protected $layout;
    protected $name;
    protected $dir;
    public $default_layout;
    protected $template_engine;
    protected $components;

    const LAYOUT_LEFT_COLUMN = 'layout_left_column.tpl';
    const LAYOUT_RIGHT_COLUMN = 'layout_right_column.tpl';
    const LAYOUT_BOTH = 'layout_both.tpl';
    const LAYOUT_FULL_WIDTH = 'layout_full_width.tpl';
    const LAYOUT_CONTENT_ONLY = 'content_only.tpl';
    const LAYOUT_ERROR = 'error.tpl';
    const POSITION_HEADER = '';
    const POSITION_CONTENT = '';
    const POSITION_FOOTER = '';

    public function __construct($name) {
        $this->name = $name;
        $this->template_engine = KernelService::getService('SmartyTemplateManagementService');
        $this->initTheme();
    }

    public function initTheme() {
        $this->setLayout();
    }

    public function getLayout() {
        return $this->layout;
    }

    public function getThemeDir() {
        return $this->dir . \DIRECTORY_SEPARATOR . $this->name;
    }

    public function addComponents($components) {
        $this->components = $components;
    }

    public function setLayout($layout = self::LAYOUT_BOTH) {
        $this->layout = $layout;
    }

    public function publish() {
        $tpl = $this->dir . $this->name . '\layout\\' . $this->getLayout();
        $layout = $this->template_engine->createTemplate($tpl);
        $content = '';
        if (is_array($this->components)) {
            foreach ($this->components as $component) {
                $content .= $component->renderComponent();
            }
        } else {
            $content = $this->components->renderComponent();
        }
        $layout->assign('content', $content);
        $layout_tpl = $layout->fetch();
        echo trim($layout_tpl);
    }

}
