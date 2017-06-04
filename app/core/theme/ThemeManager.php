<?php

namespace app\core\theme;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of ThemeProvider
 *
 * @author adapter
 */
class ThemeManager {

    public static function getInstalledThemes() {
        $finder = new Finder();
        $finder->depth(0)->directories()->in(_THEMES_DIR_);
        foreach ($finder as $dir) {
            if (file_exists($dir->getPathName() . DS . $dir->getFileName() . '.info.yml')) {
                $themeDirectories [$dir->getFileName()] = ($dir->getPathName());
            }
        }
        return $themeDirectories;
    }

    /**
     * gets the data of all components in one single array
     * @return Array of components data
     */
    public function getThemesData() {
        $data = [];
        foreach (static::getInstalledThemes() as $dir => $path) {
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

    public function getActiveTheme() {
        $data = [];
        $active = 'system';
        foreach (static::getInstalledThemes() as $dir => $path) {
            if ($dir === $active) {
                $data[$dir] = $path;
                break;
            }
        }
        return $data;
    }

}
