<?php

use app\core\database\Migration;

class UserShopProductCategoryMigration extends Migration
{

    public function up()
    {
        $this->schema->create('user_shop', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->integer('id_user');
            $table->integer('id_shop');
            $table->primary(['id_shop', 'id_user']);
            $table->index(['id_shop', 'id_user']);
        });
//        $this->schema->create('product_shop', function(Illuminate\Database\Schema\Blueprint $table) {
//            $table->engine = 'InnoDB';
//            // Auto-increment id
//            $table->integer('id_product');
//            $table->integer('id_shop');
//            $table->index(['id_shop', 'id_product']);
//            $table->primary(['id_shop', 'id_product']);
//        });
    }

    public function down()
    {
        $this->schema->drop('user_shop');
//        $this->schema->drop('product_shop');
    }

}
