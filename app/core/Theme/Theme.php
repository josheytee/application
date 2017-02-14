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
    protected $js = [];
    protected $css = [];

    const LAYOUT_LEFT_COLUMN = 'layout_left_column.tpl';
    const LAYOUT_RIGHT_COLUMN = 'layout_right_column.tpl';
    const LAYOUT_BOTH = 'layout_both.tpl';
    const LAYOUT_FULL_WIDTH = 'layout_full_width.tpl';
    const LAYOUT_CONTENT_ONLY = 'content_only.tpl';
    const LAYOUT_ERROR = 'error.tpl';
    const POSITION_HEADER = 'HEADER';
    const POSITION_CONTENT = 'CONTENT';
    const POSITION_FOOTER = 'FOOTER';

    public function __construct($name) {
        $this->name = $name;
        $this->template_engine = KernelService::getService('SmartyCustom');
        $this->initTheme();
    }

    public function initTheme() {
        $this->setLayout();
        $this->addCSS(_RESOURCE_DIR_ . 'bootstrap/bootstrap.min.css');
        $this->addJS(_RESOURCE_DIR_ . 'jquery/jquery-1.11.0.min.js');
        $this->addJS(_RESOURCE_DIR_ . 'bootstrap/bootstrap.min.js');
        $this->template_engine->assign('css', $this->css);
        $this->template_engine->assign('js', $this->js);
    }

    public function initHeader() {
        $header = '';
        if (isset($this->components[self::POSITION_HEADER])) {
            foreach ($this->components[self::POSITION_HEADER] as $position => $component) {
                $header .= $component->renderComponent();
            }
        }
        return $header;
    }

    public function initFooter() {
        $footer = '';
        if (isset($this->components[self::POSITION_FOOTER])) {
            foreach ($this->components[self::POSITION_FOOTER] as $position => $component) {
                $footer .= $component->renderComponent();
            }
        }
        return $footer;
    }

    public function initContent() {
        $content = '';
        if (isset($this->components[self::POSITION_CONTENT])) {
            foreach ($this->components[self::POSITION_CONTENT] as $position => $component) {
                $content .= $component->renderComponent();
            }
        }
        return $content;
    }

    public function addCSS($css, $media = 'all') {
        $media_uri = str_replace('//', '/', $css);
        $this->css[DOMAIN . $media_uri] = $media;
    }

    public function addJS($js_url) {
        if (is_array($js_url)) {
            foreach ($js_url as $value) {
                $this->js[] = $value;
            }
        } else {
            $this->js[] = DOMAIN . $js_url;
        }
    }

    public function normalizeMediaDir($media) {

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
        $layout->assign('header', $this->initHeader());
        $layout->assign('content', $this->initContent());
        $layout->assign('footer', $this->initFooter());
        $layout_tpl = $layout->fetch();
        return new \Symfony\Component\HttpFoundation\Response(
                sprintf("%s", trim($layout_tpl))
                , 200);
    }

}
