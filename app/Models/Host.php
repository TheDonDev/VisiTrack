<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = ['host_name', 'host_email', 'host_number'];

    // Define relationships if applicable
}
