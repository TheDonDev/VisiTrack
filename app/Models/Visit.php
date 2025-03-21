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
        'visitor_id',
        'purpose_of_visit',
        'host_id',
        'check_in_time',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public static function generateVisitNumber()
    {
        return Str::uuid()->toString();
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
