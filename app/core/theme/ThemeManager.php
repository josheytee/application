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
            $route_match = $this->container->get('current.route.match');
        }
//    if ($route_match instanceof StackedRouteMatchInterface) {
//      $route_match = $route_match->getMasterRouteMatch();
//    }
        $theme = $this->theme_resolver->resolveActiveTheme($route_match);
//        $this->active_theme = $this->loadTheme($theme);
        $this->active_theme = $this->themeInitializer->initTheme($theme);
    }

    /**
     *
     * @param RouteMatchInterface|null $route_match
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
