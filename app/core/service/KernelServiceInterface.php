<?php

namespace app\core\service;

/**
 * Description of KernelServiceInterface
 *
 * @author Tobi
 */
interface KernelServiceInterface {

    public static function start();

    public function stop();
}
