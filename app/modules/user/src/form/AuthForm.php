<?php

namespace ntc\user\form;

use app\core\controller\FormController;
use app\core\http\Request;
use app\core\http\UploadedFile;
use app\core\view\form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of UserForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AuthForm extends FormController
{

    public static function inject(ContainerInterface $container)
    {
        return new static();
    }

    public function build(FormBuilder $builder, $entity)
    {
        $builder->block(
            $builder->label('username')
            , $builder->text('username', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);
        $builder->block(
            $builder->label('password')
            , $builder->password('password', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('remember_me')
            , $builder->checkbox('remember_me', '')
        )->addAttributes(['class' => 'form-group']);

        $builder->block($builder->submit('Login', 'Login')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);
        return $builder;
    }

    public function formID()
    {
        return 'user';
    }

    public function process(Request $request)
    {
        if (!$request->session()->has('logged')) {
//            dump($request->all());
            if (isset($request->username)) {
                $doctrine = $this->doctrine();
                $user = $doctrine->getRepository('app\core\entity\User');
                $data = $user->findOneBy(['username' => $request->username]);
                if ($data) {
                    $request->session()->set('logged', $data->getId());
                    $this->redirect('admin.index');
                }
            }
        } else
            $this->redirect('admin.index');
    }

    function title()
    {
        // TODO: Implement title() method.
    }

    function handleFile($entity, UploadedFile $file)
    {
        // TODO: Implement handleFile() method.
    }

    public function validationRules()
    {
        // TODO: Implement validationRules() method.
    }
}
