<?php

use app\core\database\Migration;

class RouteMigration extends Migration
{

    public function up()
    {
        $this->schema->create('routes', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->longText('object');
        });
    }

    public function down()
    {
        $this->schema->drop('routes');
    }
}