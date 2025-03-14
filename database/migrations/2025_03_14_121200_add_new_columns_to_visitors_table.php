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
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('first_name')->after('visitor_name');
            $table->string('last_name')->after('visitor_last_name');
            $table->string('email')->after('visitor_email');
            $table->string('phone_number')->after('visitor_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'email', 'phone_number']);
        });
    }
};
