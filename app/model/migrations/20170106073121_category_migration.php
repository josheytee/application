<?php

use app\core\database\Migration;

class CategoryMigration extends Migration
{

    public function up()
    {
        $this->schema->create('category', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id_category');
            $table->string('name');
            $table->string('description');
            $table->string('icon');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id_category');
        });
    }

    public function down()
    {
        $this->schema->drop('category');
    }

}
