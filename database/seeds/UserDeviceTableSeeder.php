<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserDeviceTableSeeder extends Seeder
{
    public function run()
    {
        for($x = 1; $x <= 10; $x++){
            DB::table('users_device')->insert([
                'users_id' => $x,
                'device_id' => $x
            ]);
        }
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('users_device');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}