<?php


namespace app\core\repository\handler;


class ThemeRepositoryHandler extends BaseHandler {

    public function getConfiguration($key = null) {
        return $this->parseFile('.config.yml', $key);
    }
}