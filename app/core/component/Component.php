<?php

namespace app\core\component;

use app\core\Context;
use app\core\view\Renderabletrait;
use Symfony\Component\Finder\Finder;

/**
 * Description of Component
 *
 * @author Tobi
 */
abstract class Component {

    use Renderabletrait;

    public $name;
    public $description;
    public $icon;
    public $version;
    public $region;
    public $dependency = [];

    function __construct($details) {
        $details += [
            'name' => '',
            'description' => '',
            'icon' => '',
            'version' => '',
            'dependency' => [],
            'region' => '',
            'path' => '',
            'target' => 'front',
        ];
        $this->name = $details['name'];
        $this->description = $details['description'];
        $this->icon = $details['icon'];
        $this->version = $details['version'];
        $this->dependency = $details['dependency'];
        $this->region = $details['region'];
        $this->path = $details['path'];
        $this->target = $details['target'];
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
//            var_dump($_POST);
        }
    }

    /**
     * @todo find a better alternative for getting templates
     * @param Finder $dir
     * @param type $file
     * @return type
     */
//    public function getTemplate($dir, $file = null) {
//        $finder = new Finder();
//        $finder->depth(0)->directories()->in($dir);
//        foreach ($finder as $dir) {
//            if ($dir->getrelativePathname() == 'templates') {
//                if (file_exists($dir->getPathName() . DS . $file)) {
//                    return $dir->getPathName() . DS . $file;
//                } else {
//                    return "invalid template: " . $dir->getPathName() . DS . $file;
//                }
//            }
//        }
//    }

    /**
     * @todo find a better alternative for getting templates
     * @return type
     * @internal param Finder $dir
     * @internal param type $file
     */
    public function getTemplate() {
        return '';
    }

    public function display($template, $data = null) {
    //        if (!empty($this->rendertrait($data, "components/{$template}_footer"))) {
    //            return $this->rendertrait($data, "components/{$template}");
    //        }
        return $this->rendertrait($data, 'components/' . $template);
    }

    public function renderComponent() {
//        dump($activeTheme);
        $this->init();
        $this->postProcess();
        return $this->rendertrait(['component' => $this->render()], 'layout/component');
    }

    protected function getContainer() {
        return Context::getContainer();
    }

}
