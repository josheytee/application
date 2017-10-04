<?php

namespace app\core\repository;

/**
 * Description of ThemeRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ThemeRepository extends Repository {

    public function __construct() {
        $this->handler = ThemeRepositoryHandler::class;
        $this->setDirectories([_THEMES_DIR_, $this->getDirectoriesFromModules(new ModuleRepository())]);
        parent::__construct();
    }

    public function getDirectoriesFromModules(ModuleRepository $module) {
        $themes = [];
        foreach ($module->getRepositories() as $package => $handler) {
            if (is_dir($handler->getPath() . DS . 'themes')) {
                $themes[$package] = $handler->getPath() . DS . 'themes';
            }
        }
        return $themes;
    }

}
