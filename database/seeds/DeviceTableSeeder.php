<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DeviceTableSeeder extends Seeder
{
    public function run()
    {
        for($x = 1; $x <= 10; $x++) {
            DB::table('device')->insert([
                'name' => 'DEVICE' . $x,
                'alias' => 'testdevice ' . $x,
                'description' => 'a test device with number ' . $x,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('device');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}