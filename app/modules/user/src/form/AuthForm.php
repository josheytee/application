<?php

namespace ntc\user\form;

use app\core\controller\FormController;
use app\core\entity\User;
use app\core\http\Request;
use app\core\view\form\Checkbox;
use app\core\view\form\FormBuilder;
use app\core\view\form\Password;
use app\core\view\form\Submit;
use app\core\view\form\Text;
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

    public function build(FormBuilder $builder)
    {
        $builder->add('username', Text::class);
        $builder->add('password', Password::class);
        $builder->add('remember_me', Checkbox::class, function ($r) {
            $r->label = '';
        });

        $builder->add('submit', Submit::class);

        return $builder;
    }

    public function process(Request $request)
    {
//        dump($request->session()->all());
        if (!$request->session()->has('logged')) {
            if (isset($request->username)) {
                $user = User::where('username', $request->username)->first();
                if ($user) {
                    $request->session()->set('logged', $user->id);
                    $this->redirect('admin.index');
                }
            }
        } else
            $this->redirect('admin.index');
    }

}
