<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'name',
        'visitor_last_name',
        'designation',
        'organization',
        'email',
        'visit_number',
        'id_number',
        'phone_number',
    ];

    // Define relationships if applicable
}
