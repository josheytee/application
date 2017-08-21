<?php

namespace app\core\repository;

use Symfony\Component\Finder\Finder;

/**
 * Description of repository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Repository implements RepositoryInterface, RepositoryValidator {

  protected $repository;
  protected $dirs;

  public function __construct() {
    $this->scan();
    $this->validate();
  }

  public function scan() {
    try {
      $finder = new Finder();
      $finder = $finder->depth(0)->directories();
      if (is_array($this->getDirectories())) {
        foreach ($this->getDirectories() as $dir) {
          $finder->in($dir);
        }
      } else {
        $finder->in($this->getDirectories());
      }
    } catch (\InvalidArgumentException $e) {
      echo $e->getMessage();
    }
    foreach ($finder as $dir) {
      $this->repository[$dir->getFileName()] = ($dir->getPathName());
    }
  }

  /**
   * validated and original repositories
   * @return type
   */
  public function getRepositories() {
    return $this->repository;
  }

  public function setDirectories($dirs) {
    $this->dirs = $dirs;
  }

  /**
   * gets the Directories that it scans
   * @return array of directories
   */
  public function getDirectories() {
    return $this->dirs;
  }

  /**
   * this validate function is creating a re-loop
   * for the this->repository field find a better way
   */
  public function validate() {
    $validated_repo = [];
    foreach ($this->repository as $name => $path) {
      if (file_exists($path . DS . $name . '.info.yml')) {
        $validated_repo[$name] = $path;
      }
    }
    $this->repository = $validated_repo;
  }

}
