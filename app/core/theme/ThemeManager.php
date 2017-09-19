<?php

namespace app\core\theme;

use app\core\config\ConfigManager;
use app\core\routing\RouteMatchInterface;
use app\core\utility\StringHelper;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Description of ThemeProvider
 *
 * @author adapter
 */
class ThemeManager implements ThemeManagerInterface {

    use ContainerAwareTrait;
    use StringHelper;

    /**
     * @var ActiveThemeResolverInterface
     */
    private $theme_resolver;

    /**
     * @var ConfigManager
     */
    private $config;
    private $active_theme;
    /**
     * @var ThemeInitializer
     */
    private $themeInitializer;

    public function __construct(ThemeInitializer $themeInitializer, ActiveThemeResolverInterface $theme_resolver, ConfigManager $config = null) {
        $this->config = $config;
        $this->theme_resolver = $theme_resolver;
        $this->themeInitializer = $themeInitializer;
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
//      $route_match = Context::routeMatch();
            $route_match = $this->container->get('current.route.match');
        }
//    if ($route_match instanceof StackedRouteMatchInterface) {
//      $route_match = $route_match->getMasterRouteMatch();
//    }
        $theme = $this->theme_resolver->resolveActiveTheme($route_match);
//        $this->active_theme = $this->loadTheme($theme);
        $this->active_theme = $this->themeInitializer->initTheme($theme);
    }

//    public function loadTheme($theme) {
//        $theme_data = $this->getThemeData($theme)['info'];
//        $value = [
//            'name' => $theme_data['name'],
//            'regions' => $theme_data['regions'],
//            'libraries' => $theme_data['libraries'],
//            'path' => $theme_data['path'],
//            'config' => $this->getThemeData($theme)['config']
//        ];
//        return new ActiveTheme($value);
//    }
//
//    /**
//     * gets the data of all components in one single array
//     * @return Array of components data
//     */
//    public function getThemesData() {
//        $data = [];
//        foreach ($this->theme_repository->getRepositories() as $id => $info) {
//            $data[$this->getModuleName($id)] = ['info' => $info, 'config' => $this->_getYamlFileIfExist
//            ($info['path'] . DS .
//                $this->getModuleName($id) . '.config.yml')];
//        }
//        return $data;
//    }
//
//    private function _getYamlFileIfExist($path) {
//        if (file_exists($path)) {
//            return Yaml::parse(file_get_contents($path));
//        }
//        return [];
//    }
//
//    /**
//     *
//     * @param Theme $theme
//     * @return type array of a single component information
//     */
//    public function getThemeData($theme) {
//        return isset($this->getThemesData()[$theme]) ? $this->getThemesData()[$theme] : null;
//    }

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
