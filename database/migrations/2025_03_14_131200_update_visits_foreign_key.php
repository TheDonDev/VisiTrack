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
        Schema::table('visits', function (Blueprint $table) {
            // Drop existing foreign key constraint
            $table->dropForeign(['visitor_id']);

            // Add new foreign key with ON DELETE CASCADE
            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // Drop the cascade foreign key
            $table->dropForeign(['visitor_id']);

            // Restore original foreign key without cascade
            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors');
        });
    }
};
