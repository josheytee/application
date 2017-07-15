<?php

namespace app\core\theme;

use Symfony\Component\Yaml\Yaml;
use app\core\theme\ThemeManagerInterface;
use app\core\repository\ThemeRepository;
use app\core\theme\ActiveTheme;
use app\core\config\ConfigManager;
use app\core\Context;
use app\core\theme\ActiveThemeResolverInterface;
use app\core\routing\RouteMatchInterface;

/**
 * Description of ThemeProvider
 *
 * @author adapter
 */
class ThemeManager implements ThemeManagerInterface {

  /**
   * @var ActiveThemeResolverInterface
   */
  private $theme_resolver;

  /**
   * @var ConfigManager
   */
  private $config;
  protected $theme_repository;
  private $active_theme;

  public function __construct(ThemeRepository $themeRepository, ActiveThemeResolverInterface $theme_resolver, ConfigManager $config = null) {
    $this->theme_repository = $themeRepository;
    $this->config = $config;
    $this->theme_resolver = $theme_resolver;
  }

  /**
   * Initializes the active theme for a given route match.
   *
   * @param \app\core\routing\RouteMatchInterface $route_match
   *   The current route match.
   */
  protected function initTheme(RouteMatchInterface $route_match = NULL) {
    // Determine the active theme for the theme negotiator service. This includes
    // the default theme as well as really specific ones like the ajax base theme.
    if (!$route_match) {
      $route_match = Context::routeMatch();
    }
//    if ($route_match instanceof StackedRouteMatchInterface) {
//      $route_match = $route_match->getMasterRouteMatch();
//    }
    $theme = $this->theme_resolver->resolveActiveTheme($route_match);
    $this->active_theme = $this->loadTheme($theme);
  }

  public function loadTheme($theme) {
    $theme_data = $this->getThemeData($theme)['info'];
    $value = ['name' => $theme_data['name'],
        'regions' => $theme_data['regions'],
        'libraries' => $theme_data['libraries'],
        'path' => $this->getThemeData($theme)['path']
    ];
    return new ActiveTheme($value);
  }

  /**
   * gets the data of all components in one single array
   * @return Array of components data
   */
  public function getThemesData() {
    $data = [];
    foreach ($this->theme_repository->getRepositories() as $dir => $path) {
      $data[$dir] = ['info' => Yaml::parse(file_get_contents($path . DS . $dir . '.info.yml')), 'path' => $path];
    }
    return $data;
  }

  /**
   *
   * @param Theme $theme
   * @return type array of a single component information
   */
  public function getThemeData($theme) {
    return isset($this->getThemesData()[$theme]) ? $this->getThemesData()[$theme] : null;
  }

  /**
   *
   * @return ActiveTheme
   */
  public function getActiveTheme(RouteMatchInterface $route_match = NULL) {
    if (!isset($this->active_theme)) {
      $this->initTheme($route_match);
    }
    return $this->active_theme;
  }

  public function render() {

  }

  public function getTheme($name) {

  }

  public function getName($theme) {

  }

  public function themeExists($theme): bool {

  }

}
