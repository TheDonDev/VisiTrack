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
        Schema::create('visit_visitor', function (Blueprint $table) {
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('visitor_id');
            $table->primary(['visit_id', 'visitor_id']); // Composite primary key
            $table->timestamps();
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_visitor');
    }
};
