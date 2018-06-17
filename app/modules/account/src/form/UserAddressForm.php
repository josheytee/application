<?php

namespace ntc\account\form;

use app\core\controller\FormController;
use app\core\entity\State;
use app\core\entity\User;
use app\core\http\Request;
use app\core\view\form\Email;
use app\core\view\form\FormBuilder;
use app\core\view\form\Select;
use app\core\view\form\Text;
use app\core\view\form\TextArea;
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
//        $builder->add('state', Select::class, function ($state) {
//            $state->options = State::all(['id', 'name']);
//        });
        $builder->add('alias', Text::class);
        $builder->add('address1', TextArea::class);
        $builder->add('address2', TextArea::class);
        $builder->add('postcode', Text::class);
        $builder->add('phone', Text::class, function ($phone) {
            $phone->label = 'Phone Number';
        });
        $builder->add('active', Text::class);

        $builder->addSubmit('save');
        return $builder;
    }

    public function createEntity(Request $request)
    {
        $array = array_diff($request->all(), ['register']);
        User::create($array);
    }
}
