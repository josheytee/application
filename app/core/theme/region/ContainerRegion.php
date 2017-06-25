<?php

namespace app\core\theme\region;

use app\core\theme\region\RegionManager;

/**
 * Description of ContainerRegionManager
 *
 */
class ContainerRegion extends RegionManager {

  public function __construct($name, $content) {
    parent::__construct($name);
    $this->content = $content;
  }

  function getContent() {
    return $this->content;
  }

  function setContent($content) {
    $this->content = $content;
    return $this;
  }

}
