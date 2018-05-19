<?php

use app\core\database\Migration;

class PaymentMigration extends Migration
{
    public function up()
    {
        $this->schema->create('payments', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->decimal('amount');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        $this->schema->drop('payments');
    }
}
