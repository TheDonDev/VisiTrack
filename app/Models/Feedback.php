<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Feedback model for handling visitor feedback.
 */
class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['visitor_id', 'name', 'email', 'feedback'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('F j, Y g:i A');
    }
}
