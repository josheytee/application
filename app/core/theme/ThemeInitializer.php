<?php

namespace app\core\theme;


use app\core\repository\ThemeRepository;
use app\core\utility\StringHelper;
use Symfony\Component\Yaml\Yaml;

class ThemeInitializer {
    use StringHelper;
    /**
     * @var ThemeRepository
     */
    private $themeRepository;


    public function __construct(ThemeRepository $themeRepository
    ) {

        $this->themeRepository = $themeRepository;

    }

    /**
     * @param $name name of the theme to initialize
     * @return ActiveTheme
     */
    public function initTheme($name) {
        $theme_data = $this->getThemeData($name)['info'];
        $value = [
            'name' => $theme_data['name'],
            'regions' => $theme_data['regions'],
            'libraries' => $theme_data['libraries'],
            'path' => $theme_data['path'],
            'config' => $this->getThemeData($name)['config']
        ];
        return new ActiveTheme($value);
    }

    /**
     * gets the data of all components in one single array
     * @return Array of components data
     */
    public function getThemesData() {
        $data = [];
        foreach ($this->themeRepository->getRepositories() as $id => $info) {
            $data[$this->getModuleName($id)] = ['info' => $info, 'config' => $this->_getYamlFileIfExist
            ($info['path'] . DS .
                $this->getModuleName($id) . '.config.yml')];
        }
        return $data;
    }

    private function _getYamlFileIfExist($path) {
        if (file_exists($path)) {
            return Yaml::parse(file_get_contents($path));
        }
        return [];
    }

    /**
     *
     * @param Theme $theme
     * @return type array of a single component information
     */
    public function getThemeData($theme) {
        return isset($this->getThemesData()[$theme]) ? $this->getThemesData()[$theme] : null;
    }

}