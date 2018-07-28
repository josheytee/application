<?php

use app\core\database\Migration;
use Kalnoy\Nestedset\NestedSet;

class SectionMigration extends Migration
{
    public function up()
    {
        $this->schema->create('sections', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->default(1);
            $table->string('name');
            $table->text('description');
            $table->string('url')->default('default_section_url');
            NestedSet::columns($table);
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();

        });
    }

    public function down()
    {
        $this->schema->drop('sections');
    }
}
