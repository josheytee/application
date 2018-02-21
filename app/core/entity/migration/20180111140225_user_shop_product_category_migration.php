<?php

use app\core\database\Migration;

class UserShopProductCategoryMigration extends Migration
{
    public function up()
    {
        $this->schema->create('shop_user', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->primary(['shop_id', 'user_id']);
            $table->index(['shop_id', 'user_id']);
        });
        $this->schema->create('product_shop', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->integer('product_id');
            $table->integer('shop_id');
            $table->index(['shop_id', 'product_id']);
            $table->primary(['shop_id', 'product_id']);
        });
    }

    public function down()
    {
        $this->schema->drop('shop_user');
        $this->schema->drop('product_shop');
    }
}
