<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ntc\administrator\component;

use app\core\component\ComponentTargetResolverInterface;
use app\core\routing\RouteMatchInterface;
use app\core\routing\AdminContext;
use Symfony\Component\Yaml\Yaml;
use app\core\repository\ModuleComponentRepository;

/**
 * Description of AdminTargetResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AdminTargetResolver implements ComponentTargetResolverInterface {

  /**
   * @var AdminContext
   */
  private $context;

  /**
   * @var ComponentRepository
   */
  private $repository;

  public function __construct(AdminContext $context, ModuleComponentRepository $repository) {

    $this->repository = $repository;
    $this->context = $context;
  }

  public function appliesTo(RouteMatchInterface $route_match) {
    return $this->context->isAdminRoute($route_match->getRouteObject());
  }

  public function resolveTarget(RouteMatchInterface $route_match) {
    $repositories = $this->repository->getRepositories();
    $components = [];
    $admin_c = [];
    foreach ($repositories as $name => $path) {
      $info = $path . DS . $name . '.info.yml';
      $components[$name] = ['info' => Yaml::parse(file_get_contents($info)), 'path' => $path];
      if (isset($components[$name]['info']['target']) && $components[$name]['info']['target'] == 'admin') {
        $admin_c[$name] = $components[$name];
      }
    }
//    dump($repositories);
//    dump($admin_c);
//    dump(array_diff_key($repositories, $admin_c));
//    dump(array_intersect_key($admin_c, $repositories));
    return (array_intersect_key($admin_c, $repositories));
  }

}
