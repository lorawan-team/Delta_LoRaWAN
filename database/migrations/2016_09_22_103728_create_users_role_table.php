<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_role', function(Blueprint $table)
        {
            $table->integer('users_id')->unsigned()->index('fk_users_has_role_users1_idx');
            $table->integer('role_id')->unsigned()->index('fk_users_has_role_role1_idx');
            $table->primary(['users_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('users_role');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
