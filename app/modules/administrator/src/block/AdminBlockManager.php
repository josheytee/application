<?php

namespace ntc\administrator\block;

use app\core\http\Request;
use app\core\http\Response;
use app\core\routing\RouteMatchInterface;
use app\core\theme\block\BlockManagerInterface;
use app\core\theme\library\LibraryManager;
use app\core\theme\region\RegionManager;
use app\core\theme\ThemeManagerInterface;
use app\core\view\RenderableTrait;

/**
 * Description of AdminBlockManager
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AdminBlockManager implements BlockManagerInterface
{

    use RenderableTrait;

    protected $default_regions;
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
    private $regionManager;
    /**
     * @var LibraryManager
     */
    private $libraryManager;

    public function __construct(ThemeManagerInterface $theme,LibraryManager $libraryManager,RegionManager $regionManager,ConfigManager $config = null)
    {

        $this->theme = $theme;
        $this->regionManager = $regionManager;
        $this->default_regions = $this->theme->getActiveTheme()->getRegions();
        $this->config = $config;
        $this->libraryManager = $libraryManager;
    }

    public function generateResponse($result,Request $request,RouteMatchInterface $routeMatch)
    {
        $page = [];
        $page['title'] = $this->titleResolver->getTitle($request,$routeMatch->getRouteObject());
        foreach ($this->theme->getActiveTheme()->getRegions() as $region) {
            $page[$region] = $this->regionManager->getContent($request,$region);
        }
        $page['libraries'] = $this->libraryManager->loadLibraries($routeMatch);
        $page[$this->theme->getActiveTheme()->getMainRegion()] = $result['content'];

        return new Response($this->render($page,$routeMatch));

    }

    public function render($page,RouteMatchInterface $routeMatch)
    {
//        if ($routeMatch->getRouteObject()->hasOption('module')) {
//            $template = $routeMatch->getRouteObject()->getOption('module');
//            var_dump($this->rendertrait(['page' => $page]));
//            if (null !== ($this->rendertrait(['page' => $page], "layout/page__{$template}")))
//                return $this->rendertrait(['page' => $page], "layout/page__{$template}");
//        }

        return $this->renderTrait(['page' => $page],'layout/page');
    }
}
