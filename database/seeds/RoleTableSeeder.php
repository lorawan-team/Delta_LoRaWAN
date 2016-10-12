<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        //@TODO use model factories instead.
        for($x = 1;$x <= 10;$x++) {
            DB::table('role')->insert([
                'role' => 'testRole' . $x,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        //make additional role for testing the delete function
        DB::table('role')->insert([
            'role' => 'testRole' . $x++,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('role');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}