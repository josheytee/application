<?php

namespace app\core\html\form;

use app\core\html\form\ElementInterface;

/**
 * Description of ElementBase
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class FormElement implements ElementInterface {

  use \app\core\template\Displayable;
  use \app\core\utility\ArrayHelper;
  use \app\core\utility\StringHelper;

  protected $name;
  protected $class = [];
  protected $id;
  protected $value;
// theis should always be a key value pair
  protected $attribute = [];

  public function __construct($name, $value = null, $attributes = null) {
    $this->name = $name;
    $this->value = $value;
    if (!empty($attributes)) {
      foreach ($attributes as $key => $attribute) {
        $this->addAtribute($key, $attribute);
      }
    }
  }

  function normalize() {

    $this->addAtribute('name', $this->name);
    $this->addAtribute('id', $this->id);
  }

  function getAttributes() {
    return $this->attribute;
  }

  function addAtribute($key, $attribute) {
    $this->attribute[$key] = $attribute;
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
    return $this->display($this->compact(), 'form/' . $this->getTemplate());
  }

}
