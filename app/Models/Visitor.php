<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'visitor_name',
        'visitor_last_name',
        'first_name',
        'last_name',
        'designation',
        'organization',
        'visitor_email',
        'email',
        'id_number',
        'visitor_number',
        'phone_number',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($visitor) {
            // Map old field names to new ones if needed
            if (isset($visitor->visitor_name) && !isset($visitor->first_name)) {
                $visitor->first_name = $visitor->visitor_name;
            }
            if (isset($visitor->visitor_last_name) && !isset($visitor->last_name)) {
                $visitor->last_name = $visitor->visitor_last_name;
            }
            if (isset($visitor->visitor_email) && !isset($visitor->email)) {
                $visitor->email = $visitor->visitor_email;
            }
            if (isset($visitor->visitor_number) && !isset($visitor->phone_number)) {
                $visitor->phone_number = $visitor->visitor_number;
            }
        });
    }

    public static function findOrCreate(array $data)
    {
        // First try to find by visit number
        if (isset($data['visit_number'])) {
            $visitor = self::where('visit_number', $data['visit_number'])->first();
            if ($visitor) {
                return $visitor;
            }
        }

        // Then try to find by email
        $visitor = self::where('visitor_email', $data['visitor_email'])->first();

        // If found, update visit number if needed
        if ($visitor && isset($data['visit_number'])) {
            $visitor->visit_number = $data['visit_number'];
            $visitor->save();
            return $visitor;
        }

        // If not found, create new visitor
        return self::create($data);
    }

    public function visits()
    {
        return $this->belongsToMany(Visit::class, 'visit_visitor');
    }
}
