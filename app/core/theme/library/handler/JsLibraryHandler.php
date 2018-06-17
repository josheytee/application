<?php

namespace app\core\theme\library\handler;

use app\core\theme\ThemeManager;

class JsLibraryHandler implements LibraryHandlerInterface
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
        return 'js';
    }

    public function handleLibrary($library)
    {
        return array_map(function ($lib) {
            return $this->activeTheme->getCanonicalPath() . DS . 'js' . DS . $lib;
        },array_keys($library));
    }
}