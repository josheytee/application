<?php

namespace app\core\service;

/**
 * Description of KernelServiceInterface
 *
 * @author Tobi
 */
interface KernelServiceInterface {

    public function install();

    public function uninstall();

    public function start();

    public function stop();

    public function subscribe();

    public function unsubscribe();
}
