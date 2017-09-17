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
use app\core\repository\ComponentRepository;

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

    public function __construct(AdminContext $context, ComponentRepository $repository) {

        $this->repository = $repository;
        $this->context = $context;
    }

    public function appliesTo(RouteMatchInterface $route_match) {
        return $this->context->isAdminRoute($route_match->getRouteObject());
    }

    public function resolveTarget(RouteMatchInterface $route_match) {
        foreach ($this->repository->getRepositories() as $name => $path) {
            $info = $path . DS . $name . '.info.yml';
            $yml = Yaml::parse(file_get_contents($info));
            if ($yml['target'] == 'admin')
                $components[$name] = $yml + ['path' => $path];
        }
        return $components;
    }

}
