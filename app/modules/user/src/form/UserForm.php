<?php

namespace ntc\user\form;

use app\core\view\form\FormBuilder;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of UserForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UserForm extends FormBuilder {

  public function __construct() {

  }

  public static function inject(ContainerInterface $container) {
    return new static();
  }

  public function build() {

    $this->block(['class' => 'form-group'], $this->label('first_name', 'First Name'), $this->text('first_name', '', ['class' => 'form-control']));
    $this->block(['class' => 'form-group'], $this->label('last_name', 'Last Name'), $this->text('last_name', '', ['class' => 'form-control']));
    $this->block(['class' => 'form-group'], $this->label('e-mail_Address', 'E-mail Address'), $this->text('e-mail_Address', '', ['class' => 'form-control']));
    $this->block(['class' => 'form-group'], $this->label('password'), $this->text('password', '', ['class' => 'form-control']));
    $this->block(['class' => 'form-group'], $this->label('confirm_password', 'Confirm Password'), $this->text('confirm_password', '', ['class' => 'form-control']));
    $this->block(['class' => 'form-group'], $this->label('username'), $this->text('username', '', ['class' => 'form-control']));
    $this->block(['class' => 'form-group'], $this->label('phone_no', 'Phone Number'), $this->text('phone_no', '', ['class' => 'form-control']));
    $this->block(['class' => 'form-group'], $this->submit('register', 'Register', ['class' => 'btn btn-primary']));
  }

  public function formID() {
    return 'user';
  }

  public function process(Request $request) {

  }

}
