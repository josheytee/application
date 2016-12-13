<?php

namespace app\core\template;

/**
 * Description of Template
 *
 * @author Tobi
 */
class Template {

    protected $layout;
    protected $grid;
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function getGrid() {
        return $this->grid;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function setGrid($grid) {
        $this->grid = $grid;
    }

    public function create() {

    }

}
