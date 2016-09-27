<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(DeviceTableSeeder::class);
        $this->call(SensorTableSeeder::class);
        $this->call(MeasurementTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(UserDeviceTableSeeder::class);
    }
}
