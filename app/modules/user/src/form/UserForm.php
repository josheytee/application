<?php

namespace ntc\user\form;

use app\core\controller\FormController;
use app\core\http\Request;
use app\core\view\form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of UserForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UserForm extends FormController
{

    public static function inject(ContainerInterface $container)
    {
        return new static();
    }

    public function build(FormBuilder $builder, $entity)
    {

        $builder->block(
            $builder->label('name', 'Full Name')
            , $builder->text('name', '')
            ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('email', 'E-mail Address')
            , $builder->email('email', '')
            ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('username', 'Username')
            , $builder->text('username', '')
            ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('password', 'Password')
            , $builder->password('password', '')
            ->addAttributes(['class' => 'form-control']))
            ->addAttributes(['class' => 'form-group']);

//        $builder->block(
//            $builder->label('confirm_password', 'Confirm Password')
//            , $builder->password('confirm_password', '')
//            ->addAttributes(['class' => 'form-control', 'name' => null]))
//            ->addAttributes(['class' => 'form-group']);

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

    public function formID()
    {
        return 'user';
    }

    public function process(Request $request)
    {
//    if (isset($request->register))
//      dump($request->all());
//  }
//
        return $request->all();
    }

    function title()
    {
        // TODO: Implement title() method.
    }
}
