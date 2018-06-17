<?php

namespace app\core\theme\block;

use app\core\config\ConfigManager;
use app\core\controller\TitleResolverInterface;
use app\core\http\Request;
use app\core\http\Response;
use app\core\routing\RouteMatchInterface;
use app\core\theme\library\LibraryManager;
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
    private $regionManager;
    /**
     * @var TitleResolverInterface
     */
    private $titleResolver;
    /**
     * @var LibraryManager
     */
    private $libraryManager;

    public function __construct(ThemeManager $theme,RegionManager $regionManager,LibraryManager $libraryManager,TitleResolverInterface $titleResolver,ConfigManager $config = null)
    {

        $this->theme = $theme;
        $this->config = $config;
        $this->regionManager = $regionManager;
        $this->titleResolver = $titleResolver;
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
        if ($routeMatch->getRouteObject()->hasOption('module')) {
            $template = $routeMatch->getRouteObject()->getOption('module');
            $template = str_replace('\\','-',$template);
            if ($this->templateExist("layout/page--{$template}")) {
                return $this->renderTrait(['page' => $page],"layout/page--{$template}");
            }
        }

        return $this->renderTrait(['page' => $page],'layout/page');
    }
}
