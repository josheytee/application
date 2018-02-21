<?php

use app\core\database\Migration;

class StateMigration extends Migration
{
    public function up()
    {
        $this->schema->create('states', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
        });
    }


    public function down()
    {
        $this->schema->drop('states');
    }
}
