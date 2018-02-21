<?php

use app\core\database\Migration;

class SectionMigration extends Migration
{
    public function up()
    {
        $this->schema->create('sections', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('shop_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('url')->default('default_section_url');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index(['id', 'parent_id', 'shop_id']);
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    public function down()
    {
        $this->schema->drop('sections');
    }
}
