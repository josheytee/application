<?php

use app\core\database\Migration;

class ShopMigration extends Migration
{

    public function up()
    {
        $this->schema->create('shop', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id_shop');
            $table->integer('id_category')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('url');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id_category');
            $table->foreign('id_category')->references('id_category')->on('category');
        });
    }

    public function down()
    {
        $this->schema->drop('shop');
    }

}
