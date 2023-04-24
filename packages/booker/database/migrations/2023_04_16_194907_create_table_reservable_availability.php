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
        Schema::create('reservable_availability', function (Blueprint $table) {
           $table->morphs('reservable');
           $table->unsignedBigInteger('availability_id');

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
        Schema::dropIfExists('reservable_availability');
    }
};
