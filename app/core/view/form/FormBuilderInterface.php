<?php

namespace app\core\view\form;

use app\core\http\Request;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface FormBuilderInterface {

  public function formID();

  public function build();

  public function process(Request $request);
}
