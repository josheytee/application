<?php

namespace app\core\component;

use app\core\routing\RouteMatchInterface;
use app\core\repository\ComponentRepository;
use Symfony\Component\Yaml\Yaml;

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
        foreach ($this->repository->getRepositories() as $name => $path) {
            $info = $path . DS . $name . '.info.yml';
            $yml = Yaml::parse(file_get_contents($info));
            $components[$name] = $yml + ['path' => $path];
        }
        return $components;
    }

}
