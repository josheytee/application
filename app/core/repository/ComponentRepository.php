<?php

namespace app\core\repository;

/**
 * Description of ComponentRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentRepository extends Repository
{

    protected $components_dir;
    protected $module_repository;

    public function __construct()
    {
        $this->setDirectories($this->getComponentDirs());
        $this->handler = handler\ComponentRepositoryHandler::class;
        parent::__construct();
    }

    /**
     * get components from the user directory, components directory and module directory
     * and merges all together
     * @return array
     */
    public function getComponentDirs()
    {
        return $this->components_dir = array_merge(['ntc' => _COMPONENT_DIR_],
            $this->getComponentsDirFromModules(new ModuleRepository()), $this->getComponentsFromUsers());
    }

    public function getComponentsDirFromModules(ModuleRepository $moduleRepository)
    {
        foreach ($moduleRepository->getRepositories() as $id => $repository) {
            if (is_dir($repository->getPath() . DS . 'components')) {
                $components[$id] = $repository->getPath() . DS . 'components';
            }
        }
        return $components;
    }

    public function getComponentsFromUsers()
    {
        return [];
    }
}
