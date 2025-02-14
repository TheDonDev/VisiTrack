<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = ['name', 'email', 'phone_number'];

    // Define relationships if applicable
}
