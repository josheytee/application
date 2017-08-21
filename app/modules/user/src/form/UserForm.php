<?php

namespace ntc\user\form;

use app\core\view\form\FormBuilder;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\controller\FormController;

/**
 * Description of UserForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UserForm extends FormController {

  public static function inject(ContainerInterface $container) {
    return new static();
  }

  public function build(FormBuilder $builder) {

    $builder->block(
                    $builder->label('first_name', 'First Name')
                    , $builder->text('first_name', '')
                    ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

    $builder->block(
                    $builder->label('last_name', 'Last Name')
                    , $builder->text('last_name', '')
                    ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

    $builder->block(
                    $builder->label('e-mail', 'E-mail Address')
                    , $builder->email('email', '')
                    ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

    $builder->block(
                    $builder->label('username', 'Username')
                    , $builder->password('username', '')
                    ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

    $builder->block(
                    $builder->label('password', 'Password')
                    , $builder->password('password', '')
                    ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

    $builder->block(
                    $builder->label('confirm_password', 'Confirm Password')
                    , $builder->password('confirm_password', '')
                    ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

    $builder->block(
                    $builder->label('phone', 'Phone Number')
                    , $builder->text('phone', '')
                    ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);


    $builder->block(
                    $builder->submit('register', 'Register')
                    ->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);

    return $builder;
  }

  public function formID() {
    return 'user';
  }

  public function process(Request $request) {
//    if (isset($request->register))
//      dump($request->all());
//  }
//
    return $request->all();
  }

}
