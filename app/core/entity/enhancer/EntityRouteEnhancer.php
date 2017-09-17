<?php

namespace app\core\entity\enhancer;

use app\core\routing\enhancer\RouteEnhancerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;


/**
 * Enhances an entity form route with the appropriate controller.
 */
class EntityRouteEnhancer implements RouteEnhancerInterface {

    /**
     * {@inheritdoc}
     */
    public function enhance(array $defaults, Request $request) {
        if (empty($defaults['_controller'])) {
            if (!empty($defaults['_edit_form'])) {
                $defaults = $this->enhanceEntityEditForm($defaults);
            } elseif (!empty($defaults['_delete_form'])) {
                $defaults = $this->enhanceEntityDeleteForm($defaults);
            } elseif (!empty($defaults['_list'])) {
                $defaults = $this->enhanceEntityList($defaults);
            }
            return $defaults;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function applies(Route $route) {
        return !$route->hasDefault('_controller') &&
                ($route->hasDefault('_edit_form') || $route->hasDefault('_delete_form') || $route->hasDefault('_list')
                );
    }

    /**
     * Update defaults for entity forms.
     *
     * @param array $defaults
     *   The defaults to modify.
     * @return array The modified defaults.
     * The modified defaults.
     * @internal param Request $request The Request instance.*   The Request instance.
     */
    protected function enhanceEntityForm(array $defaults) {
        $defaults['_controller'] = $defaults['_entity_form'] . '::create';
        return $defaults;
    }

    /**
     * Update defaults for entity forms.
     *
     * @param array $defaults
     *   The defaults to modify.
     * @return array The modified defaults.
     * The modified defaults.
     * @internal param Request $request The Request instance.*   The Request instance.
     */
    protected function enhanceEntityEditForm(array $defaults) {
        $defaults['_controller'] = $defaults['_edit_form'] . '::update';
        return $defaults;
    }

    /**
     * Update defaults for entity forms.
     *
     * @param array $defaults
     *   The defaults to modify.
     * @return array The modified defaults.
     * The modified defaults.
     * @internal param Request $request The Request instance.*   The Request instance.
     */
    protected function enhanceEntityDeleteForm(array $defaults) {
        $defaults['_controller'] = $defaults['_delete_form'] . '::delete';
        return $defaults;
    }

    /**
     * Update defaults for an entity list.
     *
     * @param array $defaults
     *   The defaults to modify.
     * @return array The modified defaults.
     * The modified defaults.
     * @internal param Request $request The Request instance.*   The Request instance.
     */
    protected function enhanceEntityList(array $defaults) {
        $defaults['_controller'] = $defaults['_list'] . '::listing';
        unset($defaults['_list']);

        return $defaults;
    }

}
