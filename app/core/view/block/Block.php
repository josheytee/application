<?php

namespace app\core\view\block;

use app\core\Context;

/**
 * Description of Block
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Block {

  private $definition;
  private $configuration;
  private $tag;
  private $attributes;
  private $content;
  private $name;

  /**
   *
   * @param array $configuration [id,label,tag,class]
   * @param array $definition [content,libraries]
   */
  public function __construct(array $configuration, array $definition) {
    $this->configuration = $configuration;
    $this->definition = $definition;
  }

  public function getContent() {
    $byRegion = Context::componentManager()->getByRegion($this->name);
    foreach ($byRegion as $key => $component) {

    }
  }

}
