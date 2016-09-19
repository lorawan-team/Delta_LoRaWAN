<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSensorDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sensor_data', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('sensor_id')->unsigned()->index('fk_sensor_data_sensor1_idx');
			$table->integer('value');
			$table->dateTime('created_at');
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
		Schema::drop('sensor_data');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
