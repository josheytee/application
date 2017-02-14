<?php

use app\core\database\Migration;

class UserMigration extends Migration {

    public function up() {
        $this->schema->create('user', function(Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id_user');
            $table->integer('id_current_shop')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username');
            $table->string('password');
            $table->string('remember_token');
            $table->string('email');
            $table->string('phone');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index(['email', 'username']);
        });
    }

    public function down() {
        $this->schema->drop('user');
    }

}
