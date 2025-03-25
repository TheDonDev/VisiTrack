<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Visit extends Model
{
    use HasFactory;
protected $fillable = [
    'visit_number', // Ensure visit_number is unique
    'visitor_id',
    'host_id',
    'visit_type',
    'visit_facility',
    'visit_date',
    'visit_from',
    'visit_to',
    'purpose_of_visit',
    'check_in_time',
];


    protected $casts = [
        'visit_date' => 'date',
    ];

    public static function generateVisitNumber()
    {
        return rand(100000, 999999);
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

    public function visitors()
    {
        return $this->belongsToMany(Visitor::class, 'visit_visitor');
    }
}
