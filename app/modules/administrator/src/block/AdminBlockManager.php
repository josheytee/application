<?php

namespace ntc\administrator\block;

use app\core\view\block\BlockManagerInterface;
use app\core\routing\RouteMatchInterface;
use app\core\theme\ThemeManagerInterface;
use app\core\http\Response;
use app\core\component\ComponentManager;
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
   * @var ComponentManager
   */
  private $component_manager;

  /**
   * @var ThemeManager
   */
  private $theme;

  public function __construct(ThemeManagerInterface $theme, ComponentManager $component_manager, ConfigManager $config = null) {

    $this->theme = $theme;
    $this->component_manager = $component_manager;
    $this->config = $config;
  }

  public function generateResponse($result, $request, RouteMatchInterface $route_match) {
    $page = null;
    $regions = $this->theme->getActiveTheme()->getRegions();
    foreach ($regions as $region) {
//      if (!empty($page[$region])) {
//        $page[$region]['#theme_wrappers'][] = 'region';
      $page[$region] = $this->processRegion($region);
//      }
    }
//    $libraries = $result['libraries'];
    $page['content'] = $result['content'];
    $response = new Response($this->render($page));
    return $response;
  }

  public function processRegion($region) {
    $byRegion = $this->component_manager->getRegionComponents($region);
    $markup = '';
    foreach ($byRegion as $key => $component) {
      $markup .= $component->render();
    }
    $assign = [
//        'attributes' => 'class="lead"',
        'content' => $markup
    ];
    return $this->rendertrait($assign, 'layout/region.tpl');
  }

  public function render($request) {
    return $this->rendertrait(['page' => $request], 'layout/page.tpl');
  }

  public function init() {

  }

}
