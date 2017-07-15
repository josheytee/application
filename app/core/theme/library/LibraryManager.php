<?php

namespace app\core\theme\library;

use app\core\theme\ActiveTheme;

/**
 * Description of LibraryManager
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class LibraryManager {

  /**
   * @var ActiveTheme
   */
  private $theme;

  public function __construct(ActiveTheme $theme) {

    $this->theme = $theme;
  }

  public function getLibraries() {
    return $this->theme->getLibraries();
  }

}
