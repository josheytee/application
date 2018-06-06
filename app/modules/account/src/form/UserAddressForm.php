<?php

namespace ntc\account\form;

use app\core\controller\FormController;
use app\core\entity\User;
use app\core\http\Request;
use app\core\view\form\Email;
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
class UserAddressForm extends FormController
{


    /**
     * @param ContainerInterface $container
     * @return static
     */
    public static function inject(ContainerInterface $container)
    {
        return new static();
    }

    public function build(FormBuilder $builder)
    {
        $builder->add('firstname', Text::class);
        $builder->add('lastname', Text::class);
        $builder->add('username', Text::class);
        $builder->add('password', Password::class);
//        $builder->add('confirm_password', Password::class);
        $builder->add('phone', Text::class, function ($phone) {
            $phone->label = 'Phone Number';
        });
        $builder->add('email', Email::class);

        $builder->add('register', Submit::class);
        return $builder;
    }

    public function createEntity(Request $request)
    {
        $array = array_diff($request->all(), ['register']);
        User::create($array);
    }
}
