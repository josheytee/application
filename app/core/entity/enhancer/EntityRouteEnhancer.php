<?php

namespace app\core\entity\enhancer;

use app\core\routing\enhancer\RouteEnhancerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

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
                $defaults = $this->enhanceEntityEditForm($defaults, $request);
            } elseif (!empty($defaults['_delete_form'])) {
                $defaults = $this->enhanceEntityDeleteForm($defaults, $request);
            } elseif (!empty($defaults['_list'])) {
                $defaults = $this->enhanceEntityList($defaults, $request);
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
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The Request instance.
     *
     * @return array
     *   The modified defaults.
     */
    protected function enhanceEntityForm(array $defaults, Request $request) {
        $defaults['_controller'] = $defaults['_entity_form'] . '::create';
        return $defaults;
    }

    /**
     * Update defaults for entity forms.
     *
     * @param array $defaults
     *   The defaults to modify.
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The Request instance.
     *
     * @return array
     *   The modified defaults.
     */
    protected function enhanceEntityEditForm(array $defaults, Request $request) {
        $defaults['_controller'] = $defaults['_edit_form'] . '::update';
        return $defaults;
    }

    /**
     * Update defaults for entity forms.
     *
     * @param array $defaults
     *   The defaults to modify.
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The Request instance.
     *
     * @return array
     *   The modified defaults.
     */
    protected function enhanceEntityDeleteForm(array $defaults, Request $request) {
        $defaults['_controller'] = $defaults['_delete_form'] . '::delete';
        return $defaults;
    }

    /**
     * Update defaults for an entity list.
     *
     * @param array $defaults
     *   The defaults to modify.
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The Request instance.
     *
     * @return array
     *   The modified defaults.
     */
    protected function enhanceEntityList(array $defaults, Request $request) {
        $defaults['_controller'] = $defaults['_list'] . '::listing';
        unset($defaults['_list']);

        return $defaults;
    }

}
