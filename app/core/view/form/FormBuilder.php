<?php

namespace app\core\view\form;

use app\core\view\form\elements;
use app\core\view\form\FormBuilderInterface;
use app\core\view\form\elements\Select;

/**
 * handles form building
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Formbuilder implements FormBuilderInterface {

  use \app\core\view\Renderabletrait;
  use \app\core\utility\ArrayHelper;

  protected $elements;
  protected $labels;
  protected $attributes;
  protected $method = 'POST';

  /**
   * adds label for a element with the same name
   * @param type $for
   * @param type $value
   * @return type
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

  public function submit($name, $value = '') {
    return $this->elements[$name] = $this->element('submit', $name, $value);
  }

  public function reset($name, $value = '') {
    return $this->elements[$name] = $this->element('reset', $name, $value);
  }

  public function radio($name, $value = '') {
    if (is_array($value)) {
      foreach ($value as $radio) {
        $mu[] = $this->elements['radio_' . $name] = $this->element('radio', $name, $radio);
      }
      return $mu;
    } else {
      return $this->elements[$name] = $this->element('radio', $name, $value);
    }
  }

  public function checkbox($name, $value = []) {
    if (is_array($value)) {
      foreach ($value as $radio) {
        $mu[] = $this->elements['checkbox_' . $name] = $this->element('checkbox', $name, $radio);
      }
      return $mu;
    } else {
      return $this->elements[$name] = $this->element('checkbox', $name, $value);
    }
    return $this->elements[$name] = $this->element('checkbox', $name, $value);
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
          unset($element);
        } else {
          unset($this->elements[$element->name]);
        }
      }
    }
    return $this->elements[$key] = $block;
  }

  private function element($type, $name, $value = '') {
    $type = \ucfirst($type);
    $el_class = "app\\core\\view\\form\\elements\\{$type}";
    return new $el_class($name, $value);
  }

  private function getAttributes() {
    return $this->processArray([
                'id' => $this->formID(),
                'class' => 'form',
                'method' => $this->getMethod(),
                'action' => ''
    ]);
  }

  public function formID() {
    return '2e.e';
  }

  public function render() {
    $form = '';
    foreach ($this->elements as $element) {
      $form .= $element->render();
    }
    return $this->rendertrait(
                    [
                'attributes' => $this->getAttributes(),
                'form_body' => $form
                    ], 'form/form.tpl');
  }

  public function fetch() {
    return $this->render();
  }

  public function getMethod() {
    return $this->method;
  }

}
