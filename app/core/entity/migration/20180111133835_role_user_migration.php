<?php

use app\core\database\Migration;

class RoleUserMigration extends Migration
{
    public function up()
    {

        $this->schema->create('role_user', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->engine = 'InnoDB';
            // Autoincrement id
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->primary(['role_id', 'user_id']);
        });
    }

    public function down()
    {
        $this->schema->drop('role_user');
    }
}
