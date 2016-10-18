<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DeviceTableSeeder extends Seeder
{
    public function run()
    {
        for($x = 1; $x <= 11; $x++) {
            DB::table('device')->insert([
                'name' => 'DEVICE' . $x,
                'alias' => 'testdevice ' . $x,
                'eui' => '00:80:00:00:00:00:BE:' . $x,
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