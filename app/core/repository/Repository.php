<?php

namespace app\core\repository;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of repository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Repository implements RepositoryInterface, RepositoryValidator {

    protected $repository;
    protected $dirs;
    protected $handler;

    public function __construct() {
        $this->scan();
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
          $this->validate($dir);
        }
    }


  /**
   * {@inheritdoc}
   */
  public function validate($dir) {
    if (file_exists( $dir->getPathName(). DS . $dir->getFileName() . '.info.yml')) {
      $info = $dir->getPathName() . DS .  $dir->getFileName() . '.info.yml';
      $yml = Yaml::parse(file_get_contents($info));
      $this->repository[$yml['package'] ?? ''] = new $this->handler($dir->getFileName(), $dir->getPathName());
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

}
