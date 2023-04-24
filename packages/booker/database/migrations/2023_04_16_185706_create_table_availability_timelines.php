<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('availability_timelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('availability_id');
            $table->unsignedMediumInteger('time_from');
            $table->unsignedMediumInteger('time_to');
            $table->unsignedSmallInteger('day_no');
            $table->timestamps();

            $table->foreign('availability_id')
                ->references('id')
                ->on('availabilities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availability_timelines');
    }
};
