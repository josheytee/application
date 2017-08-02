<?php

namespace app\core\component;

use app\core\routing\RouteMatchInterface;
use app\core\repository\ComponentRepository;

/**
 * Description of ComponentResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class DefaultTargetResolver implements ComponentTargetResolverInterface {

  /**
   * @var ComponentRepository
   */
  private $repository;

  public function __construct(ComponentRepository $repository) {
    $this->repository = $repository;
  }

  public function appliesTo(RouteMatchInterface $route_match) {
    return true;
  }

  public function resolveTarget(RouteMatchInterface $route_match) {
    echo 'default components';
    return $this->repository->getRepositories();
  }

}
