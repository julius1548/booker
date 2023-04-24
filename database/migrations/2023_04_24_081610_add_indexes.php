<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->index(['reservable_type', 'cancelled_at', 'from', 'to']);
        });

        Schema::table('availability_timelines', function (Blueprint $table) {
            $table->index(['availability_id', 'day_no', 'time_from', 'time_to'], 'availability_timeline_from_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex(['reservable_type', 'cancelled_at', 'from', 'to']);
            $table->dropIndex('availability_timeline_from_to');
        });
    }
};
