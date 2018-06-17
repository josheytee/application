<?php

namespace app\core\theme\library\handler;

/**
 * LibraryHandlerInterface
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface LibraryHandlerInterface
{
    public function key();

    public function handleLibrary($library);
}
