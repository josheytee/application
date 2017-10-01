<?php

namespace app\core\view\form;

use app\core\utility\ArrayHelper;
use app\core\view\BuilderInterface;
use app\core\view\form\elements;
use app\core\view\form\elements\Select;
use app\core\view\Renderabletrait;

/**
 * handles form building
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Formbuilder implements BuilderInterface {

  use Renderabletrait;
  use ArrayHelper;

  protected $elements;
  protected $labels;
  protected $help_blocks;
  protected $attributes = '';
  protected $method = 'POST';

  public function __construct($template = null) {
    $this->setFormTemplate($template);
  }

  /**
   * adds label for a element with the same name
   * @param string $for
   * @param string $value
   * @return elements\Label
   */
  public function label($for, $value = '') {
    $this->labels[$for] = 'id_' . $for;
    return $this->elements[md5($for)] = $this->element('label', $for, $value);
  }

  public function text($name, $value = '') {
    return $this->elements[$name] = $this->element('text', $name, $value);
  }

  public function email($name, $value = '') {
    return $this->elements[$name] = $this->element('email', $name, $value);
  }

  public function password($name, $value = '') {
    return $this->elements[$name] = $this->element('password', $name, $value);
  }

  public function file($name, $value = '') {
    return $this->elements[$name] = $this->element('file', $name, $value);
  }

  public function submit($value = '') {
    $name = '';
    return $this->elements[$name] = $this->element('submit', $name, $value);
  }

  public function reset($name, $value = '') {
    return $this->elements[$name] = $this->element('reset', $name, $value);
  }

  public function radio($name, $value = '', $default = '') {
    if (is_array($value)) {
      foreach ($value as $radio) {
        $mu[$name][$radio] = $this->element('radio', $name, $radio, $default);
      }
      return $this->elements[$name] = $mu;
    }
    return $this->elements[$name] = $this->element('radio', $name, $value);
  }

  public function checkbox($name, $value = null, $default = null) {
    if (is_array($value)) {
      foreach ($value as $checkbox) {
        $mu[$name][$checkbox] = $this->element('checkbox', $name, $checkbox);
      }
      return $this->elements[$name] = $mu;
    }
    return $this->elements[$name] = $this->element('checkbox', $name, $value, $default);
  }

  public function select($name, $value = '', $default = null) {
    return $this->elements[$name] = new Select($name, $value, $default);
  }

  public function block(...$elements) {
    $key = uniqid('block_');
    $name = $attributes['name'] ?? '';
    $block = new elements\Block($name);
    if (isset($elements)) {
      $block->addElements($elements);
      foreach ($elements as $element) {
        if (is_array($element)) {
          foreach ($element as $name => $group) {
            unset($this->elements[$name]);
          }
        } else {
          unset($this->elements[$element->name]);
        }
      }
    }
    return $this->elements[$key] = $block;
  }

  public function help($text) {
    $name = uniqid();
    $this->help_blocks[$name] = $name;
    return $this->elements[$name] = $this->element('help', $name, $text);
  }

  public function textArea($name, $value = '') {
    return $this->elements[$name] = $this->element('textArea', $name, $value);
  }

  private function element($type, $name, $value = '', $default = null) {
    $type = \ucfirst($type);
    $el_class = "app\\core\\view\\form\\elements\\{$type}";
    return new $el_class($name, $value, $default);
  }

  public function getAttributes() {
    return $this->attributes;
  }

  /**
   * @param mixed $attributes
   * @return $this
   */
  public function setAttributes($attributes) {
    $this->attributes = $attributes;
    return $this;
  }

  protected $form_template = 'form/form';

  /**
   * @param string $form_template
   * @return $this
   */
  public function setFormTemplate($form_template) {
    if ($form_template) {
      $this->form_template = $form_template;
    }
    return $this;
  }

  public function fetch() {
    $form = '';
    foreach ($this->elements as $element) {
      if (is_array($element)) {
        foreach ($element as $name => $group) {
          foreach ($group as $key => $button) {
            $form .= $button->render();
          }
        }
      }
      $form .= $element->render();
    }
    return $this->rendertrait(
      [
        'attributes' => $this->getAttributes(),
        'form_body' => $form
      ], $this->form_template);
  }

  public function getMethod() {
    return $this->method;
  }

}
