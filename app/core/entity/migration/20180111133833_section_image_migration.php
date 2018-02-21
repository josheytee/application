<?php

use app\core\database\Migration;

class SectionImageMigration extends Migration
{
    public function up()
    {
        $this->schema->create('section_images', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('section_id')->unsigned()->nullable()->index();
            $table->string('name');
            $table->string('path');
            $table->decimal('size');
            $table->string('mimeType');
            $table->string('type');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }


    public function down()
    {
        $this->schema->drop('section_images');
    }
}
