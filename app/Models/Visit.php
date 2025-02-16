<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        'visitor_name',
        'visitor_last_name',
        'designation',
        'organization',
        'visitor_email',
        'visit_number',
        'id_number',
        'visit_type',
        'visit_facility',
        'visit_date',
        'visit_from',
        'visit_to',
        'purpose_of_visit',
        'host_id',
        'check_in_time',
    ];

    public static function generateVisitNumber()
    {
        do {
            $visitNumber = Str::random(8); // Generate a random string of 8 characters
        } while (self::where('visit_number', $visitNumber)->exists()); // Ensure uniqueness

        return $visitNumber;
    }

    // Define relationships
    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    /**
     * Get the feedback associated with the visit.
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
