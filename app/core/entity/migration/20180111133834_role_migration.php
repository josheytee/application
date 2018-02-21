<?php

use app\core\database\Migration;

class RoleMigration extends Migration
{
    public function up()
    {
        $this->schema->create('roles', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->string('name');
            $table->longText('permissions');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index(['id', 'shop_id']);
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    public function down()
    {
        $this->schema->drop('roles');
    }
}
