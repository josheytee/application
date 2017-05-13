<?php

namespace app\core;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 *
 * @author adapter
 */
interface AppInterface extends HttpKernelInterface, ContainerAwareInterface {

}
