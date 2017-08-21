<?php

namespace app\core\view\form\elements;

use app\core\view\form\FormElement;
use app\core\view\form\elements\Option;
use app\core\view\form\elements\OptionGroup;

/**
 * Description of Select
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Select extends FormElement {

  protected $template = 'select.tpl';
  protected $default = '';
  protected $options = [];

  /**
   * echo Form::select('size', array('L' => 'Large', 'S' => 'Small'), 'S');

   *  array(
    'Cats' => array('leopard' => 'Leopard','lion'=>'Lion'),
    'Dogs' => array('spaniel' => 'Spaniel'),
    ))
   * @param type $name
   * @param type $value
   * @param type $default
   * @param type $attribute
   */
  public function __construct($name, $value = null, $default = '', $attribute = null) {
    parent::__construct($name, $value, $attribute);
    $this->default = $default;
  }

  /**
   * extract from processValue()
   * @param type $key
   * @param type $value
   */
  private function _addGroup($key, $value) {
    $this->options[$key] = new OptionGroup($key);

    foreach ($value as $o_key => $o_value) {
      $selected = ($this->default == $o_key) ? true : false;
      $this->options[$key]->addOptions(new Option($o_key, $o_value, $selected));
    }
  }

  public function processValue() {
    if (is_array($this->value)) {
      foreach ($this->value as $key => $value) {
        if (is_array($value)) {
          $this->_addGroup($key, $value);
        } else {
          $this->options[$key] = new Option($key, $value, ($this->default == $key) ? true : false);
        }
      }
    }
    return $this->options;
  }

  public function compact(): array {
    $this->processValue();

    return [
        'attributes' => $this->processAttribute(),
        'options' => $this->options,
        'default' => $this->default
    ];
  }

}
