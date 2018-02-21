<?php

use app\core\database\Migration;

class ProductMigration extends Migration
{
    public function up()
    {
        $this->schema->create('products', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->decimal('price', 10, 2);
            $table->enum('condition', ['new', 'used', 'refurbished']);
            $table->enum('type', ['simple', 'virtual', 'pack']);
            $table->boolean('availability');
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->text('link_rewrite')->nullable();
            $table->integer('quantity');
            $table->integer('quantity_discount')->nullable();
            $table->integer('minimal_quantity')->nullable();
            $table->boolean('active');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();

            $table->index(['id', 'section_id']);
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    public function down()
    {
        $this->schema->drop('products');
    }
}
