<?php

use app\core\database\Migration;

class ModuleShopMigration extends Migration
{
    public function up()
    {
        $this->schema->create('module_shop', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('module_id')->unsigned()->nullable()->index();
            $table->integer('shop_id')->unsigned()->nullable()->index();
            $table->longText('data')->unsigned()->nullable()->index();
            $table->primary(['shop_id', 'module_id']);
            $table->index(['shop_id', 'module_id']);
        });
    }

    public function down()
    {
        $this->schema->drop('module_shop');
    }
}
