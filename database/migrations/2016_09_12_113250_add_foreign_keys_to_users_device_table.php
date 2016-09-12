<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersDeviceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_device', function(Blueprint $table)
		{
			$table->foreign('device_id', 'fk_users_has_device_device1')->references('id')->on('device')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('users_id', 'fk_users_has_device_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_device', function(Blueprint $table)
		{
			$table->dropForeign('fk_users_has_device_device1');
			$table->dropForeign('fk_users_has_device_users1');
		});
	}

}
