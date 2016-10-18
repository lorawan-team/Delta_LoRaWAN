<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSensorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sensor', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name', 45);
            $table->string('alias', 45);
            $table->text('description');
			$table->integer('device_id')->unsigned()->index('fk_sensor_device1_idx');
			$table->timestamps();
			$table->softDeletes();
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
		Schema::drop('sensor');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
