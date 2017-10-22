<?php

namespace app\core\database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Seed\AbstractSeed;

/**
 * Description of Seed
 *
 * @author Tobi
 */
class Seeder extends AbstractSeed
{

    protected function init()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => DB_HOST,
            'port' => DB_PORT,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'engine' => 'Innodb'
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
    }

}
