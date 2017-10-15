<?php

namespace app\core\repository;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface RepositoryValidator {

  /**
   * validate the repository
   * @param $dir
   * @return mixed
   */
  public function validate($dir);
}
