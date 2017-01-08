<?php

use app\core\database\Migration;

class SectionMigration extends Migration {

    public function up() {
        $this->schema->create('section', function(Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Auto-increment id
            $table->increments('id_section');
            $table->integer('id_parent')->unsigned()->default(1);
            $table->integer('id_shop')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('url')->default('default_section_url');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
//            $table->index(['id_section', 'id_parent', 'id_shop']);
            $table->foreign('id_shop')->references('id_shop')->on('shop');
        });
    }

    public function down() {
        $this->schema->drop('section');
    }

}
