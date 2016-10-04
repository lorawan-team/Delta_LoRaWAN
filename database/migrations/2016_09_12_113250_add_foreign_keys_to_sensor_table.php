<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSensorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sensor', function(Blueprint $table)
		{
			$table->foreign('device_id', 'fk_sensor_device1')->references('id')->on('device')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sensor', function(Blueprint $table)
		{
			$table->dropForeign('fk_sensor_device1');
		});
	}

}
