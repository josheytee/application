<?php

namespace app\core\access;

/**
 * Value object indicating a neutral access result, with cacheability metadata.
 */
class AccessResultForbidden extends AccessResult
{

  /**
   * {@inheritdoc}
   */
  public static function isForbidden()
  {
    return TRUE;
  }

}
