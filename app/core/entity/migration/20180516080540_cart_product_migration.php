<?php

use app\core\database\Migration;

class CartProductMigration extends Migration
{
    public function up()
    {
        $this->schema->create('cart_product', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('cart_id')->unsigned()->nullable()->index();
            $table->integer('product_id')->unsigned()->nullable()->index();
        });
    }

    public function down()
    {
        $this->schema->drop('cart_product');
    }
}
