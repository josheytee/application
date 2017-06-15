<?php

namespace app\core\repository;

/**
 * Description of ThemeRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ThemeRepository extends Repository {

  public function __construct() {
    $this->setDirectories([_THEMES_DIR_,]);
    parent::__construct();
  }

}
