<?php

namespace ntc\administrator\controller;

use app\core\controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\template\SmartyTemplateEngine;

/**
 * Description of AdminController
 *
 * @author adapter
 */
class AdminController extends ControllerBase {

    protected $smarty;

    public function __construct(SmartyTemplateEngine $temp) {
        $this->smarty = $temp;
    }

    public static function inject(ContainerInterface $container) {
        return new static($container->get('smarty'));
    }

    public function hello() {
        return $this->renderCustom(__DIR__. '/../../templates/testing.tpl', ['c' => 'welcome to the admin page']);
    }

    function title() {
        // TODO: Implement title() method.
    }
}
