<?php

namespace ntc\shop\theme;

use app\core\routing\RouteMatchInterface;
use app\core\theme\ActiveThemeResolverInterface;
use ntc\shop\routing\ShopContext;

/**
 * ShopThemeResolver
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ShopThemeResolver implements ActiveThemeResolverInterface
{

    /**
     * @var ShopContext
     */
    private $context;

    public function __construct(ShopContext $context)
    {
        $this->context = $context;
    }

    public function applies(RouteMatchInterface $route_match)
    {
        return $this->context->isShopRoute($route_match->getRouteObject());
    }

    public function resolveActiveTheme(RouteMatchInterface $route_match)
    {
        return 'ntc\shop\new-shop';
    }

}
