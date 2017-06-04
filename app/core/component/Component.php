<?php

namespace app\core\component;

use Symfony\Component\Finder\Finder;
use app\core\component\ComponentProvider;
use app\core\Context;
use app\core\controller\ControllerBase;

/**
 * Description of Component
 *
 * @author Tobi
 */
abstract class Component extends ControllerBase {

    use \app\core\template\Displayable;

    public $name;
    public $description;
    public $icon;
    public $version;
    public $region;
    public $dependency = [];

    function __construct() {

        $details = ComponentProvider::getComponentData(lcfirst(get_class($this)));
        $details += [
            'name' => '',
            'description' => '',
            'icon' => '',
            'version' => '',
            'dependency' => [],
            'region' => '',
        ];
        $this->name = $details['name'];
        $this->description = $details['description'];
        $this->icon = $details['icon'];
        $this->version = $details['version'];
        $this->dependency = $details['dependency'];
        $this->region = $details['region'];
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setErrorTemplate($template) {
//        $this->getTemplatePath($template);
    }

    public function init() {

    }

    abstract public function render();

    public function postProcess() {
        if (!empty($_POST) /* || isset($_GET) */) {
            var_dump($_POST);
        }
    }

    public function getTemplate($dir, $file = null) {
        $finder = new Finder();
        $finder->depth(0)->directories()->in($dir);
        foreach ($finder as $dir) {
            if (file_exists($dir->getPathName() . DS . $file)) {
                return $dir->getPathName() . DS . $file;
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

    public function renderComponent() {
        $this->init();
        $this->postProcess();
        return $this->display(['component' => $this->render()], 'layout/component.tpl');
    }

}
