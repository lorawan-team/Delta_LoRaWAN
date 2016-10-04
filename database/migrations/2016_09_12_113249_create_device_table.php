<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeviceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('device', function(Blueprint $table)
		{
            $table->increments('id', 10);
			$table->string('name', 45);
            $table->string('alias', 45);
            $table->string('token', 20)->default(str_random(20));
            $table->text('description');
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
		Schema::drop('device');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
