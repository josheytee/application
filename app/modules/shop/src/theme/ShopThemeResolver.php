<?php

namespace ntc\shop\theme;

use app\core\entity\Shop;
use app\core\repository\ModuleRepository;
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
    /**
     * @var ModuleRepository
     */
    private $repository;

    public function __construct(ShopContext $context, ModuleRepository $repository)
    {
        $this->context = $context;
        $this->repository = $repository;
    }

    public function applies(RouteMatchInterface $route_match)
    {
        return $this->context->isShopRoute($route_match->getRouteObject());
    }

    public function resolveActiveTheme(RouteMatchInterface $route_match)
    {
        $url = $route_match->getParameter('url');
        $shop = Shop::where('url', $url)->first();
        if (isset($url) && !empty($shop->theme)) {
            return $shop->theme;
        }
        return $this->repository->getRepository('ntc\shop')->getCustom('default')['default_theme'];
    }

}
