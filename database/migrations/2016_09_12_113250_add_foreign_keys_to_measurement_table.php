<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMeasurementTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('measurement', function(Blueprint $table)
        {
            $table->foreign('sensor_id', 'fk_measurement_sensor1')->references('id')->on('sensor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('measurement', function(Blueprint $table)
        {
            $table->dropForeign('fk_measurement_sensor1');
        });
    }

}
