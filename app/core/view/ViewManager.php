<?php

namespace app\core\view;

use app\core\component\ComponentManager;
use app\core\Context;
use app\core\http\Response;
use app\core\theme\ThemeManager;
use app\core\theme\ThemeManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of ViewManager
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ViewManager implements Renderable
{

    protected $template_engine;
    protected $theme_manager;
    /**
     * @var app\core\component\ComponentManager
     */
    private $component_manager;

    public function __construct(ThemeManagerInterface $themeManager, ComponentManager $component_manager)
    {
        $this->theme_manager = $themeManager;
        $this->component_manager = $component_manager;
    }

    public function display($content = null, $tpl = null)
    {
        $this->theme_manager = new ThemeManager();
        $smarty = Context::smarty();
        foreach ($this->theme_manager->getActiveTheme() as $path) {
            $template = $path . DS . 'templates' . DS . $tpl;
            $tpl = $smarty->createAndFetch($template, $content);
        }
        return new Response($tpl);
    }

    public function render($template, $data = null)
    {
        $active_theme = $this->theme_manager->getActiveTheme();

        $this->template_engine->output($template, $data);
    }

    public function renderResponse($result)
    {
        $activeTheme = $this->theme_manager->getActiveTheme();
        $regions = $activeTheme->getRegions();
        if (is_array($result)) {
            $reponse = new JsonResponse($result);
        }
        $response = new Response();
        return $response;
    }

}
