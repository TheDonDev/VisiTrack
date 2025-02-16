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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visit_number')->unique();
            $table->foreignId('visitor_id')->constrained('visitors');
            $table->foreignId('host_id')->constrained('hosts');
            $table->enum('visit_type', ['Business', 'Official', 'Educational', 'Social', 'Tour', 'Other']);
            $table->enum('visit_facility', ['Library', 'Administration Block', 'Science Block', 'Auditorium', 'SHS']);
            $table->date('visit_date');
            $table->time('visit_from');
            $table->time('visit_to');
            $table->text('purpose_of_visit');
            $table->timestamp('check_in_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
