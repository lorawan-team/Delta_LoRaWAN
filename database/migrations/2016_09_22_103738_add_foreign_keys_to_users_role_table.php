<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersRoleTable extends Migration
{
    public function up(){
        Schema::table('users_role', function(Blueprint $table)
        {
            $table->foreign('role_id', 'fk_users_has_role_role1')->references('id')->on('role')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('users_id', 'fk_users_has_role_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    public function down(){
        Schema::table('users_role', function(Blueprint $table)
        {
            $table->dropForeign('fk_users_has_role_role1');
            $table->dropForeign('fk_users_has_role_users1');
        });
    }
}