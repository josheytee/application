<?php

namespace app\core\theme;

use Symfony\Component\Yaml\Yaml;
use app\core\theme\ThemeManagerInterface;
use app\core\repository\ThemeRepository;

/**
 * Description of ThemeProvider
 *
 * @author adapter
 */
class ThemeManager implements ThemeManagerInterface {

  protected $theme_repository;

  public function __construct(ThemeRepository $themeRepository) {
    $this->theme_repository = $themeRepository;
  }

  /**
   * gets the data of all components in one single array
   * @return Array of components data
   */
  public function getThemesData() {
    $data = [];
    foreach ($this->theme_repository->getRepositories() as $dir => $path) {
      $data[$dir] = Yaml::parse(file_get_contents($path . DS . $dir . '.info.yml'));
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
   * Get the current user active theme with its data
   * @return array of active theme information
   */
  public function getActiveThemeData() {
    return $this->getThemeData('system');
  }

  /**
   *
   * @return array of path and name of the active theme
   */
  public function getActiveTheme() {
    $data = [];
    $active = 'system';
    foreach ($this->theme_repository->getRepositories() as $dir => $path) {
      if ($dir === $active) {
        $data[$dir] = $path;
        break;
      }
    }
    return $data;
  }

  public function getTheme($name) {

  }

  public function getName($theme) {

  }

  public function themeExists($theme): bool {

  }

}
