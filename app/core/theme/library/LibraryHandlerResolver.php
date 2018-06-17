<?php

namespace app\core\theme\library;

use app\core\theme\library\handler\LibraryHandlerInterface;

/**
 * Description of LibraryHandler
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class LibraryHandlerResolver
{
    private $handlers;

    public function __construct($handlers = [])
    {
        $this->handlers = $handlers;
    }

    public function applies($type,$key): bool
    {
        return $type == $key;
    }

    /**
     * Adds a active theme handler service.
     *
     *   The theme handler to add.
     * @param LibraryHandlerInterface $handler
     *   Priority of the theme handler.
     */
    public function addHandler(LibraryHandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    public function resolveLibrary($library,$type)
    {
        foreach ($this->getHandlers() as $handler)
            if ($this->applies($type,$handler->key())) {
                return $handler->handleLibrary($library);
            }
    }


    /**
     * Returns the sorted array of theme negotiators.
     *
     * @return array LibraryHandlerInterface[]
     *   An array of theme negotiator objects.
     *
     *
     * @return LibraryHandlerInterface[]|array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

}
