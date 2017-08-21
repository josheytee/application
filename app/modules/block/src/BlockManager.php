<?php

namespace ntc\block;

use app\core\view\Renderable;
use app\core\theme\ThemeManager;
use app\core\config\ConfigManager;
use ntc\block\Block;
use app\core\http\Request;
use app\core\component\ComponentManager;

/**
 * Description of TemplateSkeleton
 *
 * @author adapter
 */
class BlockManager implements Renderable {

  /**
   * @var ComponentManager
   */
  private $component_manager;

  use \app\core\template\Displayable;

  /**
   * @var Request
   */
  private $request;

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

  public function __construct(Request $request, ThemeManager $theme, ComponentManager $component_manager, ConfigManager $config = null) {

    $this->theme = $theme;
    $this->config = $config;
    $this->default_regions = $this->theme->getActiveTheme()->getRegions();
    $this->request = $request;
    $this->component_manager = $component_manager;
  }

  public function init() {
//    foreach ($this->getRegions() as $region) {
//      $this->regions[$region] = new Block($region);
//    }
    $this->regions['container'] = new Block('container', $this->getContainerContent());
  }

  public function initAdmin() {
    $this->regions['container'] = new Block('container', $this->getContainerContent());
  }

  public function getRegions() {
//    $user_region = $this->config->get('user.regions');
//    return array_merge($this->default_regions, $user_region);
    return $this->default_regions;
  }

  public function isAdminRequest() {
    return $this->request->isAdmin();
  }

  public function getContainerContent() {
    return $this->container_content;
  }

  public function setContainerContent($container_content) {
    $this->container_content = $container_content;
    return $this;
  }

  public function render() {
    if ($this->isAdminRequest()) {
      $this->initAdmin();
    } else {
      $this->init();
    }
    return $this->display(['regions' => $this->regions], 'layout/html.tpl');
  }

  public function generateResponse($result, $request) {
    $this->component_manager;
  }

}
