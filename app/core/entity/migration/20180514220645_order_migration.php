<?php

use app\core\database\Migration;

class OrderMigration extends Migration
{
    public function up()
    {
        $this->schema->create('orders', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('cart_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->string('reference');
            $table->text('shipping_number');
            $table->integer('total_product');
            $table->decimal('amount_paid');
            $table->text('active');
            $table->date('delivery_date');
            $table->date('invoice_date');


            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('payment_id')->references('id')->on('payments');

        });
    }

    public function down()
    {
        $this->schema->drop('orders');
    }
}
