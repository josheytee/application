<?php

namespace ntc\account\controller;

use app\core\controller\ControllerBase;
use app\core\controller\ListController;
use app\core\http\Request;
use app\core\repository\ModuleRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RoleListing extends ListController
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

    public function listing(Request $request)
    {
        dump(serialize([]));
//        dump($this->moduleRepository->getRepositories());
        foreach ($this->moduleRepository->getRepositories() as $namespace => $handler) {
            dump($handler->getPermissions());
        }
        return ['content' => 'dnmw;oqm'];
    }

    function head()
    {
        // TODO: Implement head() method.
    }

    function row($entity)
    {
        // TODO: Implement row() method.
    }

    function rowOperations($entity)
    {
        // TODO: Implement rowOperations() method.
    }

    function headOperations($entity)
    {
        // TODO: Implement headOperations() method.
    }

    function bulkOperation()
    {
        // TODO: Implement bulkOperation() method.
    }
}