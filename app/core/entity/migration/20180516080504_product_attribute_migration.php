<?php

use app\core\database\Migration;

class ProductAttributeMigration extends Migration
{

    public function up()
    {
        $this->schema->create('product_attributes', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->string('name');
            $table->text('attribute');
            $table->text('description')->nullable();
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    public function down()
    {
        $this->schema->drop('product_attributes');
    }}
