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
}