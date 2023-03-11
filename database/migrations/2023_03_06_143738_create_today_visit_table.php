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
        Schema::create('today_visit', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->integer("patient_id");
            $table->integer("schedule_id");
            $table->string('visit_code');
            $table->integer('visit_interval');
            $table->boolean("is_signed");
            $table->time("sign_time")->nullable();
            $table->string("sign_url")->nullable();
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
        Schema::dropIfExists('today_visit');
    }
};
