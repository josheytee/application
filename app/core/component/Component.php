<?php

namespace app\core\component;

use app\core\Context;
use app\core\controller\ControllerTrait;
use app\core\view\RenderableTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Component base class
 *
 * @author Tobi
 */
abstract class Component implements ContainerAwareInterface {

    use RenderableTrait;
    use ControllerTrait;
    use ContainerAwareTrait;

    public $name;
    public $description;
    public $icon;
    public $version;
    public $region;
    public $dependency = [];
    private $defaultTemplate;
    private $type;
    private $target;
    private $path;

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
//        if (!empty($_POST) /* || isset($_GET) */) {
//            var_dump($_POST);
//        }
    }


    /**
     * should be prepended with __DIR__ if the template is in the component directory
     * @param $template
     */
    public function setDefaultTemplate($template) {
        $this->defaultTemplate = $template;
    }

    public function getDefaultTemplate() {
        return $this->defaultTemplate;
    }

    /**
     * gets the current region that the component is being rendered
     */
    public function getRegion() {
        $this->region;
    }

  public function getTarget()
  {
    return $this->target;
}
    /**
     * Displays template from theme directory and components directory or a custom directory
     * @param $template
     * @param null $data
     * @return mixed
     */
    public function display($template, $data = null) {
        if ($this->templateExist("components/{$template}-{$this->region}")) {
            return $this->renderTrait($data, "components/{$template}-{$this->region}");
        }
        if ($this->templateExist("components/{$template}")) {
            return $this->renderTrait($data, 'components/' . $template);
        }
        return $this->renderCustomTrait($this->defaultTemplate, $data);
    }

    public function renderComponent($region = null) {
        $this->region = $region;
        $this->init();
        $this->postProcess();
        return $this->renderTrait(['component' => $this->render()], 'layout/component');
    }
}
