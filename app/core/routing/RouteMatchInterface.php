<?php

namespace app\core\routing;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface RouteMatchInterface
{

    /**
     * Returns the route name.
     *
     * @return string|null
     *   The route name. NULL if no route is matched.
     */
    public function getRouteName();

    /**
     * Returns the route object.
     *
     * @return \Symfony\Component\Routing\Route|null
     *   The route object. NULL if no route is matched.
     */
    public function getRouteObject();

    /**
     * Returns the processed value of a named route parameter.
     *
     * Raw URL parameters are processed by the parameter conversion system, which
     * does operations such as converting entity ID parameters to fully-loaded
     * entities. For example, the path node/12345 would have a raw node ID
     * parameter value of 12345, while the processed parameter value would be the
     * corresponding loaded node object.
     *
     * @param string $parameter_name
     *   The parameter name.
     *
     * @return mixed|null
     *   The parameter value. NULL if the route doesn't define the parameter or
     *   if the parameter value can't be determined from the request.
     *
     */
    public function getParameter($parameter_name);

    /**
     * Returns the bag of all processed route parameters.
     *
     * Raw URL parameters are processed by the parameter conversion system, which
     * does operations such as converting entity ID parameters to fully-loaded
     * entities. For example, the path node/12345 would have a raw node ID
     * parameter value of 12345, while the processed parameter value would be the
     * corresponding loaded node object.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     *   The parameter bag.
     *
     */
    public function getParameters();

    /**
     * Returns the raw value of a named route parameter.
     *
     * @param string $parameter_name
     *   The parameter name.
     *
     * @return string|null
     *   The raw (non-upcast) parameter value. NULL if the route doesn't define
     *   the parameter or if the raw parameter value can't be determined from the
     *   request.
     *
     * @see \app\core\routing\RouteMatchInterfaceerface::getParameter()
     */
    public function getRawParameter($parameter_name);

    /**
     * Returns the bag of all raw route parameters.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     *   The parameter bag.
     *
     * @see \app\core\routing\RouteMatchInterfacerface::getParameters()
     */
    public function getRawParameters();
}
