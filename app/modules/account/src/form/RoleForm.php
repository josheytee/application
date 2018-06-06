<?php

namespace ntc\account\form;

use app\core\controller\FormController;
use app\core\entity\Role;
use app\core\http\Request;
use app\core\repository\ModuleRepository;
use app\core\view\form\FormBuilder;
use app\core\view\form\Text;
use ntc\shop\form\field\CurrentShop;
use ntc\user\form\field\RolePermissions;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * RoleForm creates roles with permission for the current shop
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RoleForm extends FormController
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('module.repository'));
    }

    public function build(FormBuilder $builder)
    {
        $builder->add('shop_id', CurrentShop::class);
        $builder->add('name', Text::class);
        $builder->add('permissions', RolePermissions::class, function ($permissions) {
            $permissions->repo = $this->moduleRepository->getRepositories();
        });
        $builder->addSubmit('save');

        return $builder;
    }

    public function createEntity(Request $request)
    {
        if (Role::create($request->all())) {
            return true;
        }
    }

}
