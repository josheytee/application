<?php

use app\core\database\Migration;

class CategoryMigration extends Migration
{
    public function up()
    {
        $this->schema->create('categories', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('icon');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
        });
    }


    public function down()
    {
        $this->schema->drop('categories');
    }
}
