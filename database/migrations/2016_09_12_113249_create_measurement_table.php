<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMeasurementTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sensor_id')->unsigned()->index('fk_measurement_sensor1_idx');
            $table->JSON('value');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
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
        Schema::drop('measurement');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
