<?php

use app\core\database\Migration;

class CarrierMigration extends Migration
{
    public function up()
    {
        $this->schema->create('carriers', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->string('name');
            $table->string('url');
            $table->decimal('price');
            $table->string('logo');
            $table->boolean('active');
            $table->boolean('is_free');
            $table->string('delay');
            $table->integer('grade');
            $table->integer('max_width');
            $table->integer('max_height');
            $table->integer('max_depth');
            $table->integer('max_weight');
            // Required for Eloquent's created_at and updated_at columns
            $table->softDeletes();
            $table->timestamps();
            $table->index('id');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    public function down()
    {
        $this->schema->drop('carriers');
    }
}