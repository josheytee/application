<?php

namespace app\core\html\form;

use app\core\Context;

/**
 * Description of FormBuilder
 *
 * @author adapter
 */
class FormBuilder {

    protected $_input;
    protected $_labels;
    protected $_form;
    protected $_textarea;
    protected $_dropdown;
    protected $_types;
    protected $_ignore;
    protected $_error;
    protected $action;
    protected $model;
    protected $method;

    public function __construct($action = null, $method = null, $options = null) {
        $this->method = $method ?? 'post';
        $this->action = $action;
        $this->_initialize();
        $this->open($options);
    }

    private function _initialize() {
        $this->_types = ['text', 'password', 'date', 'number', 'search', 'switch', 'submit', 'reset', 'radio', 'checkbox', 'file'];
        $this->_ignore = ['submit', 'reset'];
    }

    public function beforeOpen() {

    }

    public function open($options = null) {
        $options['action'] = $this->action;
        $options['method'] = $this->method;

        if (isset($options['files']) && $options['files']) {
            $options['enctype'] = 'multipart/form-data';
        }
        $this->_form = "<form" . $this->attributes($options) . ".> \n";
    }

    public function close() {
        return "\n</form>";
    }

    public function afterClose() {

    }

    private function input($type, $name, $options = null) {
        if (!in_array($type, $this->_types)) {
            $this->_error['type'][] = $type . ' type not supported yet';
        }
        $options['name'] = $name;
        $options['type'] = $type;
        $check = ['id', 'placeholder'];
        foreach ($check as $att) {
            if (!array_key_exists($att, $options)) {
                $options[$att] = ucfirst($name);
            }
        }

        $id = $options['id'];
        $this->_input[$id] = $options;

        $ignore = ['radio', 'checkbox'];
        if (array_key_exists($name, $this->_input) && !in_array($this->_input[$name]['type'], $ignore)) {
            $this->_error['typo'][] = '  name  ' . $name . ' already exist';
        }
        return $this;
    }

    public function text($name, $options = null) {
        return $this->input('text', $name, $options);
    }

    public function label($for, $options = null) {
        $options['for'] = $for;
        $options['value'] = $options['value'] ?? $this->formatLabel($for);
        $options['class'] = $options['class'] ?? null;
        $this->_labels[$for] = $options;

        return $this;
    }

    public function dropdown($name, $default, $options = null) {

        return $this;
    }

    public function textArea($name, $options = null) {
        $options['name'] = $name;
        $this->_textarea[$name] = $options;

        return $this;
    }

    public function email($name, $options = null) {
        return $this->input('email', $name, $options);
    }

    public function password($name, $options = null) {
        return $this->input('password', $name, $options);
    }

    public function switcher($name, $options = null) {

    }

    public function date($name, $options = null) {
        return $this->input('date', $name, $options);
    }

    public function number($name, $options = null) {
        return $this->input('number', $name, $options);
    }

    public function checkbox($name, $options = null) {
        return $this->input('checkbox', $name, $options);
    }

    public function radio($name, $default, $options = null) {
        $default = (!is_array($default)) ? [$default] : $default;
        foreach ($default as $key => $val) {
            $options['value'] = $val;
            $options['id'] = $val;
            $this->input('radio', $name, $options);
        }
        return $this;
    }

    public function submit($name, $value = null) {
        return $this->input('submit', $name, $options);
    }

    public function reset($name, $value = null) {
        return $this->input('reset', $name, $options);
    }

    public function processInput($label = true) {
        $input = " ";
        foreach ($this->_input as $name => $inpt) {
            if (isset($this->_labels[$inpt['name']]) && $label) {

                $input .= "<label for=\"{$this->_labels[$inpt['name']]['for']}\""
                        . " class=\"{$this->_labels[$inpt['name']]['class']}\""
                        . ">"
                        . "{$this->_labels[$inpt['name']]['value']}"
                        . "</label> \n";
                $this->_labels[$inpt['name']] = null;
            }

            $input .= "<input ";
            foreach ($this->_input[$name] as $key => $value) {
                $input .= $key . '=' . "\"$value\" ";
            }
            $input .= "/> \n";
        }

        return $input;
    }

    public function block($html, $options, $tag = 'div') {
        $open = "<{$tag}>";
        $close = "</{$tag}>";
    }

    public function build() {
        $form = '';
        echo $this->_form . $this->processInput() . $this->close();
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param  array  $attributes
     * @return string
     */
    public function attributes($attributes) {
        $html = array();

        // For numeric keys we will assume that the key and the value are the same
        // as this will convert HTML attributes such as "required" to a correct
        // form like required="required" instead of using incorrect numerics.
        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (!is_null($element))
                $html[] = $element;
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Escape HTML entities in a string.
     *
     * @param  string  $value
     * @return string
     */
    function escape($value) {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * Build a single attribute element.
     *
     * @param  string  $key
     * @param  string  $value
     * @return string
     */
    protected function attributeElement($key, $value) {
        if (is_numeric($key))
            $key = $value;

        if (!is_null($value))
            return $key . '="' . $this->escape($value) . '"';
    }

    /**
     * Format the label value.
     *
     * @param  string  $name
     * @param  string|null  $value
     * @return string
     */
    protected function formatLabel($name) {
        return ucwords(str_replace('_', ' ', $name));
    }

    public function bind($model) {
        $context = Context::getContext();
        $user = $context->manager->find('model\User', 1);
        var_dump($user->getFirstname());
        var_dump($user);
    }

}
