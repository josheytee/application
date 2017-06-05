<?php

namespace app\core\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\dependencyInjection\ContainerInjectionInterface;
use app\core\Context;
use Symfony\Component\Finder\Finder;

/**
 * Description of Controller
 *
 * @author adapter
 */
abstract class ControllerBase implements ContainerInjectionInterface {

    public static function inject(ContainerInterface $container) {
        return new static();
    }

    public function getDoctrine() {
        return Context::getDoctrine();
    }

    public function getTemplate($dir, $file = null) {
        $template_dir = dirname(dirname($dir)) . DS . 'templates';
        $finder = new Finder();
        $finder->depth(0)->files()->in($template_dir);
        foreach ($finder as $dir) {
            if ($file == $dir->getFileName() && file_exists($dir->getPathName())) {
                return $dir->getPathName();
            } else {
                echo "invalid template" . $file;
            }
        }
    }

    public function show($template, $data = null) {
        $smarty = Context::smarty();
        $tpl = $smarty->createAndFetch($template, $data);

        return $tpl;
    }

}
