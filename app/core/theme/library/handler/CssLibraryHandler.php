<?php

namespace app\core\theme\library\handler;

use app\core\theme\ThemeManager;

class CssLibraryHandler implements LibraryHandlerInterface
{
    /**
     * @var ThemeManager
     */
    private $activeTheme;

    public function __construct(ThemeManager $themeManager)
    {
        $this->activeTheme = $themeManager->getActiveTheme();
    }

    public function key()
    {
        return 'css';
    }

    public function handleLibrary($library)
    {
        $libraries = [];
        foreach ($library as $name => $attributes) {
            $att = '';
            if (!empty($attributes)) {
                foreach ($attributes as $key => $value) {
                    $att .= "$key='$value' ";
                }
            }
            $libraries[$this->activeTheme->getCanonicalPath() . DS . 'css' . DS . $name] = $att;
        }

        return $libraries;
    }

}