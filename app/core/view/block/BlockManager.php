<?php

namespace app\core\view\block;

use app\core\config\ConfigManager;
use app\core\controller\TitleResolverInterface;
use app\core\http\Request;
use app\core\http\Response;
use app\core\routing\RouteMatchInterface;
use app\core\theme\region\RegionManager;
use app\core\theme\ThemeManager;
use app\core\view\RenderableTrait;

/**
 * Description of TemplateSkeleton
 *
 * @author adapter
 */
class BlockManager implements BlockManagerInterface
{

    use RenderableTrait;

    protected $default_regions;
    protected $regions;
    /**
     * @var ConfigManager
     */
    private $config;
    /**
     * @var ThemeManager
     */
    private $theme;
    /**
     * @var RegionManager
     */
    private $region_manager;
    /**
     * @var TitleResolverInterface
     */
    private $titleResolver;

    public function __construct(ThemeManager $theme, RegionManager $region_manager, TitleResolverInterface $titleResolver, ConfigManager $config = null)
    {

        $this->theme = $theme;
        $this->config = $config;
        $this->default_regions = $this->theme->getActiveTheme()->getRegions();
        $this->region_manager = $region_manager;
        $this->titleResolver = $titleResolver;
    }

    public function generateResponse($result, Request $request, RouteMatchInterface $routeMatch)
    {
        $page = [];
        $page['title'] = $this->titleResolver->getTitle($request, $routeMatch->getRouteObject());
        foreach ($this->default_regions as $region) {
            $page[$region] = $this->region_manager->getContent($region);
        }
//    $libraries = $result['libraries'];
        $page['content'] = $result['content'];

        $response = new Response($this->render($page, $routeMatch));
        return $response;
    }

    public function render($page, RouteMatchInterface $routeMatch)
    {
        if ($routeMatch->getRouteObject()->hasOption('module')) {
            $template = $routeMatch->getRouteObject()->getOption('module');
            $template = str_replace('\\', '-', $template);
            if ($this->templateExist("layout/page--{$template}")) {
                return $this->renderTrait(['page' => $page], "layout/page--{$template}");
            }
        }

        return $this->renderTrait(['page' => $page], 'layout/page');
    }

    public function init()
    {
        // TODO: Implement init() method.
    }
}
