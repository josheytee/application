<?php

namespace app\core\access;

/**
 * Value object indicating a neutral access result, with cacheability metadata.
 */
class AccessResultAllowed extends AccessResult
{

  /**
   * {@inheritdoc}
   */
  public function isAllowed()
  {
    return TRUE;
  }

}
