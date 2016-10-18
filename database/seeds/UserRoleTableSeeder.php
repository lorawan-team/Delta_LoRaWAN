<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserRoleTableSeeder extends Seeder
{
    public function run()
    {
        for($x = 1;$x <= 10;$x++) {
            DB::table('users_role')->insert([
                'users_id' => $x,
                'role_id' => $x,
            ]);
        }
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('users_role');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}