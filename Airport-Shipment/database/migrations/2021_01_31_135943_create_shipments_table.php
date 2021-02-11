<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('from_date');
            $table->string('from_city');
            $table->string('from_airport');
            $table->string('from_country');
            $table->date('to_date')->nullable();
            $table->string('to_city');
            $table->string('to_airport');
            $table->string('to_country');
            $table->string('item_name');
            $table->string('item_space');
            $table->date('paid_at')->nullable();
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('shipments');
    }
}
