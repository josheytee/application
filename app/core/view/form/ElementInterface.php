<?php

namespace app\core\view\form;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface ElementInterface
{

    /**
     * @return array usable for its template file
     */
    public function compact();

    /**
     * @return array Array of all values and attributes in the field
     */
    public function all();
}
