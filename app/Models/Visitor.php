<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'visitor_name',
        'visitor_last_name',
        'designation',
        'organization',
        'visitor_email',
        'visit_number',
        'id_number',
        'visitor_number',
    ];

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
