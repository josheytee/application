<?php

namespace app\core\theme\block;

use app\core\config\ConfigManager;
use app\core\Context;
use app\core\controller\TitleResolverInterface;
use app\core\http\Request;
use app\core\http\Response;
use app\core\routing\RouteMatchInterface;
use app\core\theme\library\LibraryManager;
use app\core\theme\region\RegionManager;
use app\core\theme\ThemeManager;
use app\core\view\RenderableTrait;
use ntc\account\topnav\Topnav;

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
     * @var ThemeManager
     */
    private $themeManager;
    /**
     * @var RegionManager
     */
    private $regionManager;
    /**
     * @var TitleResolverInterface
     */
    private $titleResolver;
    /**
     * @var LibraryManager
     */
    private $libraryManager;
    /**
     * @var ConfigManager
     */
    private $configManager;

    public function __construct(ThemeManager $themeManager, RegionManager $regionManager, LibraryManager $libraryManager,
                                TitleResolverInterface $titleResolver, ConfigManager $configManager = null)
    {

        $this->themeManager = $themeManager;
        $this->regionManager = $regionManager;
        $this->titleResolver = $titleResolver;
        $this->libraryManager = $libraryManager;
        $this->configManager = $configManager;
    }

    public function generateResponse($result, Request $request, RouteMatchInterface $routeMatch)
    {
        $page = [];
        $page['title'] = $this->titleResolver->getTitle($request, $routeMatch->getRouteObject());
        $page['top_nav'] = Context::componentManager()->getComponent('ntc\account\topnav', false)->renderComponent($request);
        foreach ($this->themeManager->getActiveTheme()->getRegions() as $region) {
            $page['regions'][$region] = $this->regionManager->getContent($request, $region);
        }
        $page['libraries'] = $this->libraryManager->loadLibraries($routeMatch);
        $page[$this->themeManager->getActiveTheme()->getMainRegion()] = $result['content'];

        return new Response($this->render($page, $routeMatch));
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
}
