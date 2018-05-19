<?php

use app\core\database\Migration;

class ProductProductAttributeMigration extends Migration
{

    public function up()
    {
        $this->schema->create('product_product_attributes', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->integer('product_id')->unsigned()->nullable()->index();
            $table->integer('product_attribute_id')->unsigned()->nullable()->index();
        });
    }

    public function down()
    {
        $this->schema->drop('product_product_attributes');
    }
}
