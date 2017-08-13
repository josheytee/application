<?php

namespace app\core\controller;

use app\core\view\form\Formbuilder;
use app\core\http\Request;

/**
 * Description of FormController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class FormController extends ControllerBase {

  protected $elements;

  abstract public function process(Request $request);

  public function validate(Request $request) {
    return true;
  }

  public function create(Request $request, Formbuilder $builder) {
    if ($this->validate($request)) {
      $this->process($request);
      $return['content'] = $this->build($builder)->fetch();
      return $return;
    }
  }

}
