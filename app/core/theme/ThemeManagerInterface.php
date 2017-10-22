<?php

namespace app\core\theme;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface ThemeManagerInterface
{

    /**
     * Determines whether a given theme is installed.
     *
     * @param string $theme
     *   The name of the theme (without the .theme extension).
     *
     * @return bool
     *   TRUE if the theme is installed.
     */
    public function themeExists($theme);

    public function getName($theme);

    public function getTheme($name);
}
