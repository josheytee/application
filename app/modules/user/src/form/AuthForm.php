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
class AuthForm extends FormController {

    public static function inject(ContainerInterface $container) {
        return new static();
    }

    public function build(FormBuilder $builder) {
        $builder->block(
                $builder->label('username')
                , $builder->text('username', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);
        $builder->block(
                $builder->label('password')
                , $builder->password('password', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block($builder->submit('Login', 'Login')->addAttributes(['class' => 'btn btn-primary']))
                ->addAttributes(['class' => 'form-group']);
        return $builder;
    }

    public function formID() {
        return 'user';
    }

    public function process(Request $request) {
        if (!$request->session()->has('logged')) {
            dump($request->all());
            if (isset($request->authorize)) {
                $doctrine = $this->doctrine();
                $user = $doctrine->getRepository('app\core\entity\User');
                $data = $user->findOneBy(['username' => $request->username]);
                if ($data) {
                    $request->session()->set('logged', $data->id_user);
                    $this->redirect('admin.index');
                }
            }
        } else
            $this->redirect('admin.index');
    }

}
