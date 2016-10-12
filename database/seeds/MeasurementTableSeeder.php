<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MeasurementTableSeeder extends Seeder
{
    public function run()
    {
        for($x = 1;$x <= 10;$x++) {
            DB::table('measurement')->insert([
                'sensor_id' => $x,
                'value' => '{"a": "b","c": "d"}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => null,
            ]);
        }
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('measurement');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}