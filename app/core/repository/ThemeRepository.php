<?php

namespace app\core\repository;

/**
 * Description of ThemeRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ThemeRepository extends Repository {

  public function __construct() {
    $this->setDirectories([_THEMES_DIR_, $this->getDirectoriesFromModules(new ModuleRepository())]);
    parent::__construct();
  }

  public function getDirectoriesFromModules(ModuleRepository $module) {
    $themes = [];
    foreach ($module->getRepositories() as $info) {
      if (is_dir($info['path'] . DS . 'themes')) {
        $themes[] = $info['path'] . DS . 'themes';
      }
    }
    return $themes;
  }

}
