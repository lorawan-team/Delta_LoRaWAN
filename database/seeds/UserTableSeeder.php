<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        for($x = 1; $x <= 10; $x++){
            DB::table('users')->insert([
                'name' => 'USER'. $x,
                'email' => 'user' . $x . '@test.com',
                'password' => str_random(16),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}