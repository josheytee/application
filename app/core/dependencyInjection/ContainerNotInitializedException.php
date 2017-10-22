<?php

namespace app\core\dependencyInjection;

/**
 *
 * Exception thrown when a method is called that requires a container, but the
 * container is not initialized yet.
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ContainerNotInitializedException extends \RuntimeException
{

}
