<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visit_id',
        'visitor_name',
        'feedback'
    ];

    /**
     * Get the visit associated with the feedback.
     */
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
