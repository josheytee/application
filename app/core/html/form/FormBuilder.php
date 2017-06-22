<?php

namespace app\core\html\form;

use app\core\html\form\elements;
use app\core\html\form\FormBuilderInterface;
use app\core\dependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of FormBuilder
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class FormBuilder implements FormBuilderInterface, ContainerInjectionInterface {

  use \app\core\template\Displayable;
  use \app\core\utility\ArrayHelper;

  protected $elements;
  protected $labels;
  protected $attributes;
  protected $method = 'POST';

  abstract public function formID();

  public static function inject(ContainerInterface $container) {
    return new static();
  }

  public function label($for, $value = '') {
    $this->labels[$for] = 'id_' . $for;
    return $this->elements[md5($for)] = $this->element('label', $for, $value);
  }

  public function text($name, $value = '', $attributes = []) {
    return $this->elements[$name] = $this->element('text', $name, $value, $attributes);
  }

  public function password($name, $value = '', $attributes = []) {
    return $this->elements[$name] = $this->element('password', $name, $value, $attributes);
  }

  public function file($name, $value = '', $attributes = []) {
    return $this->elements[$name] = $this->element('file', $name, $value, $attributes);
  }

  public function submit($name, $value = '', $attributes = []) {
    return $this->elements[$name] = $this->element('submit', $name, $value, $attributes);
  }

  public function reset($name, $value = '', $attributes = []) {
    return $this->elements[$name] = $this->element('reset', $name, $value, $attributes);
  }

  public function radio($name, $value = '', $attributes = []) {
    if (is_array($value)) {
      foreach ($value as $radio) {
        $mu[] = $this->elements['radio_' . $name] = $this->element('radio', $name, $radio, $attributes);
      }
      return $mu;
    } else {
      return $this->elements[$name] = $this->element('radio', $name, $value, $attributes);
    }
  }

  public function checkbox($name, $value = [], $attributes = []) {
    if (is_array($value)) {
      foreach ($value as $radio) {
        $mu[] = $this->elements['checkbox_' . $name] = $this->element('checkbox', $name, $radio, $attributes);
      }
      return $mu;
    } else {
      return $this->elements[$name] = $this->element('checkbox', $name, $value, $attributes);
    }
    return $this->elements[$name] = $this->element('checkbox', $name, $value, $attributes);
  }

  public function select($name, $value = '', $attributes = []) {
    return $this->elements[$name] = $this->element('select', $name, $value, $attributes);
  }

  public function block($attributes = [], ...$elements) {
    $key = uniqid('block_');
    $name = $attributes['name'] ?? '';
    $block = new elements\Block($name, $attributes);
    if (isset($elements)) {
      $block->addElements($elements);
      var_dump($elements);
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

  private function element($type, $name, $value = '', $attributes = []) {
    $type = \ucfirst($type);
    $el_class = "app\\core\\html\\form\\elements\\{$type}";
    return new $el_class($name, $value, $attributes);
  }

  private function getAttributes() {
    return $this->processArray([
                'id' => $this->formID(),
                'class' => 'form',
                'method' => $this->getMethod(),
                'action' => ''
    ]);
  }

  public function render() {
    $form = '';
    foreach ($this->elements as $element) {
      $form .= $element->render();
    }
    return $this->display(
                    [
                'attributes' => $this->getAttributes(),
                'form_body' => $form
                    ], 'form/form.tpl');
  }

  public function create() {
    $this->build();
    return $this->render();
  }

  public function getMethod() {
    return $this->method;
  }

}
