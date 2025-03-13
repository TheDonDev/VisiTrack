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
        'visit_number',
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
        return self::firstOrCreate(
            ['visitor_email' => $data['visitor_email']],
            $data
        );
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
