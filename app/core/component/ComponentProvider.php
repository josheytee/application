<?php

namespace app\core\component;

use app\core\module\ModuleManager;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of ComponentProvider
 *
 * @author adapter
 */
class ComponentProvider {

    /**
     * gets components directory from
     * - user component directory
     * - modules component directory and
     *  - app component directory.
     * only if their respective *.info.yml exists
     * @return array of component directories
     */
    public static function getAvailableComponents() {
        $moduleDirectories = ModuleManager::getModulesDirectory();
        $components = [];
        foreach ($moduleDirectories as $moduleDirectory) {
            if (is_dir($moduleDirectory . '/components')) {
                $finder = new Finder();
                $finder->depth(0)->directories()->in($moduleDirectory . '/components');
                foreach ($finder as $dir) {
                    if (file_exists($dir->getPathName() . DS . $dir->getFileName() . '.info.yml')) {
                        $components[$dir->getFileName()] = ($dir->getPathName());
                    }
                }
            }
        }
        return $components;
    }

    public function getComponent($component) {
        return static::getAvailableComponents()[$component];
    }

    /**
     * gets the data of all components in one single array
     * @return Array of components data
     */
    public static function getComponentsData() {
        $data = [];
        foreach (static::getAvailableComponents() as $dir => $path) {
            $data[$dir] = Yaml::parse(file_get_contents($path . DS . $dir . '.info.yml'));
        }
        return $data;
    }

    /**
     *
     * @param Component $component
     * @return type array of a single component information
     */
    public static function getComponentData($component) {
        return isset(static::getComponentsData()[$component]) ? static::getComponentsData()[$component] : null;
    }

    /**
     * Get components that belongs to a particular region in the theme
     * @param type $region
     * @return type
     */
    public function getRegionComponents($region) {
        $region_component = [];
        foreach ($this->getComponentsData() as $component => $data) {
            if ($data['region'] == $region) {
                $region_component[$component] = $this->getComponent($component);
            }
        }
        return $region_component;
    }

}
