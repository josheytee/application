<?php


namespace app\core\repository\handler;


use Symfony\Component\Yaml\Yaml;

class ThemeRepositoryHandler extends BaseHandler
{

    public function setConfig($data)
    {
//        dump($this->getConfiguration());
//        (new ArrayFinder())->get()
        dump('val', $data);
        if (isset($data) && is_array($data)) {
            $configFile = $this->getConfiguration() + $data;
        } else {
            $configFile = $this->getConfiguration();
        }
//        @chmod($this->path . DS . $this->name . '.config.yml', 0666 & ~umask());

//        dump(Yaml::dump($this->getConfiguration(),3));
//        dump($configFile);
        dump(Yaml::dump($configFile, 3));
        dump(stat($this->path . DS . $this->name . '.config.yml'));
        dump(filegroup($this->path . DS . $this->name . '.config.yml'));
        dump(fileowner($this->path . DS . $this->name . '.config.yml'));
        dump(fileperms($this->path . DS . $this->name . '.config.yml'));
        unlink($this->path . DS . $this->name . '.config.yml');
        file_put_contents($this->path . DS . $this->name . '.config.yml', Yaml::dump($configFile, 3));
//        file_put_contents('../application/app/modules/administrator/themes/shoppy/shoppy.config.yml', Yaml::dump($configFile,3));
    }

    public function getConfiguration($key = null)
    {
        return $this->parseFile('.config.yml', $key);
    }
}