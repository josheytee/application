<?php

namespace app\core\theme;


use app\core\repository\ThemeRepository;

class ThemeInitializer
{
    /**
     * @var ThemeRepository
     */
    private $themeRepository;


    public function __construct(ThemeRepository $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    /**
     * @param $name name of the theme to initialize
     * @return ActiveTheme
     */
    public function initTheme($name)
    {
        $theme_data = $this->getThemeData($name)['info'];
        $value = [
            'name' => $theme_data['name'],
            'regions' => $theme_data['regions'],
            'main_region' => $theme_data['main_region'] ?? 'content',
            'base_themes' => $theme_data['base_themes'] ?? null,
            'libraries' => $this->getThemeData($name)['libraries'],
            'path' => $this->getThemeData($name)['path'],
            'canonicalPath' => $this->getThemeData($name)['canonicalPath'],
            'config' => $this->getThemeData($name)['config']
        ];
        return new ActiveTheme($value);
    }

    /**
     *
     * @param Theme $theme
     * @return type array of a single component information
     */
    public function getThemeData($theme)
    {
        return isset($this->getThemesData()[$theme]) ? $this->getThemesData()[$theme] : null;
    }

    /**
     * gets the data of all components in one single array
     * @return array of components data
     */
    public function getThemesData()
    {
        $data = [];
        foreach ($this->themeRepository->getRepositories() as $package => $handler) {
            $data[$package] = [
                'info' => $handler->getInfo(),
                'config' => $handler->getConfiguration(),
                'path' => $handler->getPath(),
                'canonicalPath' => $handler->getCanonicalPath(),
                'libraries' => $handler->getLibraries()
            ];
        }
        return $data;
    }

    public function getThemeRepository()
    {
        return $this->themeRepository;
    }
}