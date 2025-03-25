<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Visitor extends Model
{
protected $fillable = [
    'first_name',
    'last_name',
    'email', // Ensure email is unique
    'phone_number',
    'designation',
    'organization',
    'id_number',
];


    // Removed the creating() method and the visit_number logic entirely.


    public function visits()
    {
        return $this->belongsToMany(Visit::class, 'visit_visitor');
    }
}
