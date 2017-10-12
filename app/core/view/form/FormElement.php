<?php

namespace app\core\view\form;

use app\core\utility\ArrayHelper;
use app\core\utility\StringHelper;
use app\core\view\RenderableTrait;

/**
 * Description of ElementBase
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class FormElement implements ElementInterface {

  use RenderableTrait;
  use ArrayHelper;
  use StringHelper;

  protected $name;
  protected $class = [];
  protected $id;
  protected $value;
// this should always be a key value pair
  protected $attribute = [];

  public function __construct($name, $value = null, $attributes = null) {
    $this->name = $name;
    $this->value = $value;
    $this->addAttributes($attributes);
  }

  function normalize() {

    $this->addAttribute('name', $this->name);
    $this->addAttribute('id', $this->id);
  }

  function getAttributes() {
    return $this->attribute;
  }

  function addAttribute($key, $attribute) {
    $this->attribute[$key] = $attribute;
    return $this;
  }

  function addAttributes($attributes) {
    if (!empty($attributes)) {
      foreach ($attributes as $key => $attribute) {
        $this->addAttribute($key, $attribute);
      }
    }
    return $this;
  }

  public function processAttribute() {
    return $this->processArray($this->getAttributes());
  }

  public function getTemplate() {
    return $this->template;
  }

  public function all() {
    $this->normalize();
    return $this->getAttributes();
  }

  public function __get($name) {

    $all = $this->all();
    if (array_key_exists($name, $all)) {
      return $all[$name];
    }
  }

  public function render() {
    $this->normalize();
    return $this->renderTrait($this->compact(), 'form/' . $this->getTemplate());
  }

}
