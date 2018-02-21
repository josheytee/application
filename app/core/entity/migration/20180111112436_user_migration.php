<?php

use app\core\database\Migration;

class UserMigration extends Migration
{

    public function up()
    {
        $this->schema->create('users', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id');
            $table->integer('current_shop_id')->unsigned()->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username');
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('email');
            $table->string('phone');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index(['email', 'username']);
            $table->foreign('current_shop_id')->references('id')->on('shops');

        });
    }

    public function down()
    {
        $this->schema->drop('users');
    }

}
