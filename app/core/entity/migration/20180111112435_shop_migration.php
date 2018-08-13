<?php

use app\core\database\Migration;

class ShopMigration extends Migration
{
    public function up()
    {
        $this->schema->create('shops', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('slogan')->nullable();
            $table->text('description');
            $table->string('url');
            $table->string('theme');
            $table->text('components');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        $this->schema->drop('shops');
    }

}
