<?php

namespace app\core\theme;

use app\core\routing\RouteMatchInterface;

/**
 * Description of DefaultThemeResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class DefaultThemeResolver implements ActiveThemeResolverInterface
{

    public function applies(RouteMatchInterface $route_match): bool
    {
        return true;
    }

    public function resolveActiveTheme(RouteMatchInterface $route_match)
    {
        return 'ntc\genesis';
    }

}
