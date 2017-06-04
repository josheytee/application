<?php

namespace ntc\product\controller;

use app\core\controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ntc\administrator\AdminManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of ProductController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProductController extends ControllerBase {

    protected $admin_manager;

    public function __construct(AdminManager $admin) {
        $this->admin_manager = $admin;
    }

    public static function inject(ContainerInterface $container) {
        return new static(new AdminManager());
    }

    public function hello(Request $request, $name = null) {
        var_dump($this->getDoctrine()->getRepository('model\Product')->findAll());

        return new Response($name);
    }

}
