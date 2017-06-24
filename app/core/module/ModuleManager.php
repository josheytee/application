<?php

namespace app\core\module;

use app\core\Context;
use Symfony\Component\Yaml\Yaml;
use app\core\repository\ModuleRepository;

/**
 * Description of ModuleManager
 *
 * @author adapter
 */
class ModuleManager implements ModuleManagerInterafce {

  protected $manager;
  protected $module_repository;

  public function __construct(ModuleRepository $moduleRepository) {
    $this->manager = Context::getContext()->manager;
    $this->module_repository = $moduleRepository;
  }

  public function install() {
    $module_info = Yaml\Yaml::parse(file_get_contents($com), 0);
    if (!$this->isInstalled($module_info['name'])) {
      $module = new \model\Module();
      $module->setName($module_info['name']);
      $module->setDescription($module_info['description']);
      $module->setIcon($module_info['icon']);
      $module->setVersion($module_info['version']);
      $module->setCreated(new \DateTime("now"));
      $module->setUpdated(new \DateTime("now"));
      $this->manager->persist($module);
    }
  }

  public function isInstalled($module) {
    return $module ? $this->manager->getRepository('model\Module')->findOneBy(['name' => $module]) : '';
  }

  public function uninstall() {

  }

  public function getModules() {

  }

  public function getModulesDirectory() {
    return $this->module_repository->getRepositories();
  }

}
