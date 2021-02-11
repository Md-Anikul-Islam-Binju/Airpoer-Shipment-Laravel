<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('from_date');
            $table->string('from_city');
            $table->string('from_airport');
            $table->string('from_country');
            $table->date('to_date');
            $table->string('to_city');
            $table->string('to_airport');
            $table->string('to_country');
            $table->tinyInteger('tour_days');
            $table->double('free_space', 8, 2);
            $table->double('pay_amount', 8, 2)->default(10)->nullable();
            $table->date('paid_at')->nullable();
            $table->boolean('is_completed')->default(false);
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
        Schema::dropIfExists('trips');
    }
}
