<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'designation',
        'organization',
        'id_number',
    ];

    // Removed the creating() method and the visit_number logic entirely.

    public static function findOrCreate(array $data)
    {
        // Find by email (primary identifier)
        $visitor = self::where('email', $data['email'])->first();

        if ($visitor) {
            return $visitor; // Visitor already exists
        }

        // Create a new visitor if not found
        return self::create($data);
    }

    public function visits()
    {
        return $this->belongsToMany(Visit::class, 'visit_visitor');
    }
}
