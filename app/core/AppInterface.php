<?php

namespace app\core;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 *
 * @author adapter
 */
interface AppInterface extends HttpKernelInterface, ContainerAwareInterface
{

    /**
     * Loads the container configuration.
     *
     * @param LoaderInterface $loader A LoaderInterface instance
     */
    public function registerContainerConfiguration(LoaderInterface $loader);

    /**
     * Boots the current kernel.
     */
    public function boot();

    /**
     * Shutdowns the kernel.
     *
     * This method is mainly useful when doing functional testing.
     */
    public function shutdown();

    /**
     * Gets the name of the kernel.
     *
     * @return string The kernel name
     */
    public function getName();

    /**
     * Gets the environment.
     *
     * @return string The current environment
     */
    public function getEnvironment();

    /**
     * Checks if debug mode is enabled.
     *
     * @return bool true if debug mode is enabled, false otherwise
     */
    public function isDebug();

    /**
     * Gets the application root dir.
     *
     * @return string The application root dir
     */
    public function getRootDir();

    /**
     * Gets the current container.
     *
     * @return ContainerInterface A ContainerInterface instance
     */
    public function getContainer();
}
