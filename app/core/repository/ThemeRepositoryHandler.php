<?php


namespace app\core\repository;


class ThemeRepositoryHandler extends BaseHandler {

    public function getConfiguration($key = null) {
        return $this->parseFile('.config.yml', $key);
    }
}