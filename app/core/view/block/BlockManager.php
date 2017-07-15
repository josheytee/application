<?php

namespace app\core\view\block;

use app\core\view\Renderable;
use app\core\theme\ThemeManager;
use app\core\config\ConfigManager;
use app\core\http\Response;
use app\core\component\ComponentManager;
use app\core\routing\RouteMatchInterface;

/**
 * Description of TemplateSkeleton
 *
 * @author adapter
 */
class BlockManager implements Renderable {

  use \app\core\view\Renderabletrait;

  /**
   * @var ComponentManager
   */
  private $component_manager;

  /**
   * @var ConfigManager
   */
  private $config;

  /**
   * @var ThemeManager
   */
  private $theme;
  protected $default_regions;
  protected $regions;

  public function __construct(ThemeManager $theme, ComponentManager $component_manager, ConfigManager $config = null) {

    $this->theme = $theme;
    $this->config = $config;
    $this->default_regions = $this->theme->getActiveTheme()->getRegions();
    $this->component_manager = $component_manager;
  }

  public function processRegion($region) {
    $byRegion = $this->component_manager->getByRegion($region);
    $markup = '';
    foreach ($byRegion as $key => $component) {
      $markup .= $component->render();
    }
    $assign = [
        'attributes' => 'class="lead"',
        'content' => $markup
    ];
    return $this->rendertrait($assign, 'layout/region.tpl');
  }

  public function render($request) {
    return $this->rendertrait(['page' => $request], 'layout/page.tpl');
  }

  public function generateResponse($result, $request, RouteMatchInterface $route_match) {
//    $route_match;
//    $components = $this->component_manager->getComponents();
    $page = null;
    $regions = $this->theme->getActiveTheme()->getRegions();
    foreach ($regions as $region) {
//      if (!empty($page[$region])) {
//      $page[$region]['#theme_wrappers'][] = 'region';
      $page[$region] = $this->processRegion($region);
//      }
    }
//    $libraries = $result['libraries'];
    $page['content'] = $result['content'];

    $response = new Response($this->render($page));
    return $response;
  }

}
