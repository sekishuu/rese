<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToIntInReservationsAndReviewsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('number_of_people')->change();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('evaluation')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedInteger('number_of_people')->change();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->tinyInteger('evaluation')->change();
        });
    }
}
