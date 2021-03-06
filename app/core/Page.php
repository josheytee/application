<?php

namespace app\core;

use app\core\component\Component;
use app\core\theme\Theme;

/**
 * Page is a container of components related to perform a particular task
 * it needs the @uses \app\core\theme\Theme  for layouts and positioning of the components\
 * @see Theme;
 * @author Tobi
 */
class Page
{

    const POSITION_HEADER = 'HEADER';
    const POSITION_CONTENT = 'CONTENT';
    const POSITION_FOOTER = 'FOOTER';
    const TYPE_ADMIN = 'admin';
    const TYPE_FRONT = 'front';
    public $smarty;
    protected $title;
    protected $meta = [];
    protected $name;
    protected $components;
    protected $theme;
    protected $url;

    public function __construct($name = '', $title = '')
    {
        $this->name = $name;
        $this->title = $title;
    }

    public static function getPage($page, $type = self::TYPE_FRONT)
    {
        $p = "app\page\\$type\\" . $page;

        return new $p();
    }

    public function registerComponent(Component $component, $position = self::POSITION_CONTENT)
    {
        $this->components[$position][] = $component;
    }

    public function setTheme(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function setMedia()
    {

    }

    public function create()
    {
        $this->initPage();
//        var_dump($this->components);
//        if ($this->components != null) {
        $this->theme->addComponents($this->components);
        return $this->theme->publish();
//        }
    }

    public function initPage()
    {

    }

}
