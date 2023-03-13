<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('today_schedule', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('patient_id');
            $table->integer('visit_times')->nullable();
            $table->string('visit_code');
            $table->integer('visit_interval');
            $table->time('specific_time')->nullable();
            $table->boolean("is_signed");
            $table->time("sign_time")->nullable();
            $table->string("sign_url")->nullable();
            $table->boolean('issaved');
            $table->boolean('isrepeated');
            $table->boolean('isspecific_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('today_schedule');
    }
};
