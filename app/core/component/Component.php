<?php

namespace app\core\component;

use app\core\controller\ControllerTrait;
use app\core\http\Request;
use app\core\validation\Validator;
use app\core\view\form\FormBag;
use app\core\view\form\Formbuilder;
use app\core\view\RenderableTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Component base class
 *
 * @author Tobi Agbeja tobiagbeja4 at gmail.com
 */
abstract class Component implements ContainerAwareInterface
{

    use RenderableTrait;
    use ControllerTrait;
    use ContainerAwareTrait;

    private $name;
    private $description;
    private $icon;
    private $version;
    private $region;
    private $dependency = [];
    private $defaultTemplate;
    private $type;
    private $target;
    private $path;
    private $configurable;
    private $author;

    function __construct($details)
    {
        $details += [
            'name' => '',
            'description' => '',
            'icon' => '',
            'version' => '',
            'dependency' => [],
            'region' => '',
            'path' => '',
            'target' => 'front',
            'configurable' => false,
            'author' => '',
        ];
        $this->name = $details['name'];
        $this->description = $details['description'];
        $this->icon = $details['icon'];
        $this->version = $details['version'];
        $this->dependency = $details['dependency'];
        $this->region = $details['region'];
        $this->path = $details['path'];
        $this->target = $details['target'];
        $this->configurable = $details['configurable'];
        $this->author = $details['author'];
    }

    public function setErrorTemplate($template)
    {
//        $this->getTemplatePath($template);
    }

    public function getDefaultTemplate()
    {
        return $this->defaultTemplate;
    }

    /**
     * should be prepended with __DIR__ if the template is in the component directory
     * @param $template
     */
    public function setDefaultTemplate($template)
    {
        $this->defaultTemplate = $template;
    }

    /**
     * gets the current region that the component is being rendered
     */
    public function getRegion()
    {
        $this->region;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        $app_path = substr($this->path, strrpos($this->path, '/application'), strlen($this->path));
        return $app_path . DS . $this->icon;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return array|mixed
     */
    public function getDependency()
    {
        return $this->dependency;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function isConfigurable()
    {
        return (bool)$this->configurable;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Displays template from theme directory and components directory or a custom directory
     * @param $template
     * @param null $data
     * @return mixed
     */
    public function display($template, $data = null)
    {
        if ($this->templateExist("components/{$template}-{$this->region}")) {
            return $this->renderTrait($data, "components/{$template}-{$this->region}");
        }
        if ($this->templateExist("components/{$template}")) {
            return $this->renderTrait($data, 'components/' . $template);
        }
        return $this->renderCustomTrait($this->defaultTemplate, $data);
    }

    public function renderComponent(Request $request, $region = null)
    {
        $this->region = $region;
        $this->init($request);
        return $this->renderTrait(['component' => $this->render()], 'layout/component');
    }

    public function init(Request $request)
    {

    }


    abstract public function render();

    public function renderConfig(Request $request, Formbuilder $builder)
    {
        $this->init($request);
        $this->processConfigure($request, $builder);
        return $this->configure($request, $builder);
    }

    public function processConfigure(Request $request, Formbuilder $builder)
    {

    }

    function configure(Request $request, Formbuilder $builder)
    {
        return $builder->setFormBag(new FormBag($request))->render();
    }

    public function validate($request)
    {
        $validator = new Validator($request, $this->validationRules() ?? []);
        return $validator;
    }

    public function validationRules()
    {
    }

}
