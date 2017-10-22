<?php

use app\core\database\Migration;

class ProductMigration extends Migration
{

    public function up()
    {
        $this->schema->create('product', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id_product');
            $table->integer('id_shop')->unsigned();
            $table->integer('id_section')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->boolean('availability');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();

            $table->index(['id_product', 'id_section']);
            $table->foreign('id_section')->references('id_section')->on('section');
            $table->foreign('id_shop')->references('id_shop')->on('shop');
        });
    }

    public function down()
    {
        $this->schema->drop('product');
    }

}
