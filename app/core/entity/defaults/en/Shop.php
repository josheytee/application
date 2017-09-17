<?php

namespace app\core\entity\defaults\en;



/**
 * this is just default when the shop entity is null
 * used by entity form
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class Shop {

    public function getId() {
        return 0;
    }

    public function getName() {
        return '';
    }

    public function getDescription() {
        return '';
    }

    public function getUrl() {
        return '';
    }

    public function getActivity() {
        return new Activity();
    }

}
