<?php

namespace ntc\block;

use app\core\Context;

/**
 * Description of Block
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Block {

  use \app\core\template\Displayable;
  use \app\core\utility\ArrayHelper;

  public $name;
  public $tag;
  public $attributes = [];
  public $content = '';
  public $template = 'layout/region.tpl';

  public function __construct($name, $content = '', $attributes = [], $tag = 'div') {
    $this->name = $name;
    $this->content = $content;
    $this->tag = $tag;
    if (!empty($attributes)) {
      foreach ($attributes as $key => $attribute) {
        $this->addAtribute($key, $attribute);
      }
    }
  }

  public function getAttributes() {
    return $this->attributes;
  }

  public function getContent() {
    $component_manager = Context::componentManager();
    foreach ($component_manager->getRegionComponents($this->name) as $component => $path) {
      if (file_exists($path . DS . ucwords($component) . '.php')) {
        require_once $path . DS . ucwords($component) . '.php';
        $this->content = (new $component($component_manager))->renderComponent();
      }
    }
    return $this->display(['region' => $this, 'attributes' => $this->processArray($this->attributes)], $this->template);
  }

  function addAtribute($key, $attribute) {
    $this->attributes[$key] = $attribute;
    return $this;
  }

}
