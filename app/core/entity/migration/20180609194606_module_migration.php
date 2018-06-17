<?php

use app\core\database\Migration;

class ModuleMigration extends Migration
{
    public function up()
    {
        $this->schema->create('modules', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('package');
            $table->string('author');
            $table->string('version');
            $table->longText('dependencies');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
            $table->index('id');
        });
    }

    public function down()
    {
        $this->schema->drop('modules');
    }
}