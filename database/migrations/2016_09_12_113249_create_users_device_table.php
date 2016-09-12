<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersDeviceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_device', function(Blueprint $table)
		{
			$table->integer('users_id')->unsigned()->index('fk_users_has_device_users1_idx');
			$table->integer('device_id')->unsigned()->index('fk_users_has_device_device1_idx');
			$table->primary(['users_id','device_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('users_device');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
