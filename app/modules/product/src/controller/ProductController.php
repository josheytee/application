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

    public function index() {
        return new Response('hello index page');
    }

    public function add(Request $request) {
//        var_dump($this->getDoctrine()->getRepository('model\Product')->findAll());
        var_dump($_POST);
        return new Response($this->show($this->getTemplate(__DIR__, 'add.tpl')));
    }

}
