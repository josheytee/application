<?php

namespace app\core\controller;

use app\core\http\Request;
use app\core\view\form\Formbuilder;

/**
 * This implementation uses the '_form' request attribute to determine
 * the controller to execute and uses the request attributes to determine
 * the controller method arguments. *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class FormController extends ControllerBase {

    protected $elements;

    abstract public function build(Formbuilder $request);

    abstract public function process(Request $request);

    public function validate() {
        return true;
    }

    public function create(Request $request, Formbuilder $builder) {
        if ($this->validate()) {
            $this->process($request);
            $return['content'] = $this->build($builder)->fetch();
            return $return;
        }
    }

}
