<?php

use app\core\database\Migration;

class AuthMigration extends Migration
{

    public function up()
    {
        $this->schema->create('auth', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id_auth');
            $table->integer('id_user');
            $table->integer('duration');
            $table->string('secret');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id_auth');
            $table->index('id_user');
            $table->index('secret');
        });
    }

    public function down()
    {
        $this->schema->drop('auth');
    }

}
