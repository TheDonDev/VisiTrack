<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Visit extends Model
{
    public static function generateVisitNumber()
    {
        do {
            $visitNumber = Str::random(8); // Generate a random string of 8 characters
        } while (self::where('visit_number', $visitNumber)->exists()); // Ensure uniqueness

        return $visitNumber;
    }
}
