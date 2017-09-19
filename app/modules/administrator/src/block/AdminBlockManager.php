<?php

namespace ntc\administrator\block;

use app\core\http\Request;
use app\core\http\Response;
use app\core\routing\RouteMatchInterface;
use app\core\theme\region\RegionManager;
use app\core\theme\ThemeManagerInterface;
use app\core\view\block\BlockManagerInterface;
use app\core\view\Renderabletrait;

/**
 * Description of AdminBlockManager
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AdminBlockManager implements BlockManagerInterface {

    use Renderabletrait;

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
    protected $default_regions;

    public function __construct(ThemeManagerInterface $theme, RegionManager $regionManager, ConfigManager $config = null) {

        $this->theme = $theme;
        $this->regionManager = $regionManager;
        $this->default_regions = $this->theme->getActiveTheme()->getRegions();
        $this->config = $config;
    }


    public function render($page, RouteMatchInterface $routeMatch) {
        if ($routeMatch->getRouteObject()->hasOption('module')) {
            $template = $routeMatch->getRouteObject()->getOption('module');
            if (!empty($this->rendertrait(['page' => $page], "layout/page__{$template}.tpl")))
                return $this->rendertrait(['page' => $page], "layout/page__{$template}.tpl");
        }

        return $this->rendertrait(['page' => $page], 'layout/page.tpl');
    }

    public function generateResponse($result, Request $request, RouteMatchInterface $routeMatch) {
        $page = null;
        foreach ($this->default_regions as $region) {
//      if (!empty($page[$region])) {
//      $page[$region]['#theme_wrappers'][] = 'region';
            $page[$region] = $this->regionManager->getContent($region);
//      }
        }
//    $libraries = $result['libraries'];
        $page['content'] = $result['content'];

        $response = new Response($this->render($page, $routeMatch));
        return $response;
    }

    public function init() {
        // TODO: Implement init() method.
    }
}
