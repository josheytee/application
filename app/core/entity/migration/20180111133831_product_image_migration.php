<?php

use app\core\database\Migration;

class ProductImageMigration extends Migration
{
    public function up()
    {
        $this->schema->create('product_images', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable()->index();

            $table->string('name');
            $table->string('path');
            $table->decimal('size');
            $table->string('mimeType');
            $table->string('type');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }


    public function down()
    {
        $this->schema->drop('product_images');
    }
}
