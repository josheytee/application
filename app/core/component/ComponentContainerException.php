<?php

namespace app\core\component;

/**
 * Description of ComponentContainerException
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentContainerException extends \Exception
{

    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
