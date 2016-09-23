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
}