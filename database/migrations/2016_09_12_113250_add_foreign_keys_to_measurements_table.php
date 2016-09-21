<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSensorDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sensor_data', function(Blueprint $table)
		{
			$table->foreign('sensor_id', 'fk_sensor_data_sensor1')->references('id')->on('sensor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sensor_data', function(Blueprint $table)
		{
			$table->dropForeign('fk_sensor_data_sensor1');
		});
	}

}
