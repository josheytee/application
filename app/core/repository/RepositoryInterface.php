<?php

namespace app\core\repository;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface RepositoryInterface
{

    /**
     * Scans the repository using regex if provider
     * @param type $reg
     */
    public function scan();
}
