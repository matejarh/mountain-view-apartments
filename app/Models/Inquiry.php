<?php

namespace App\Models;

use App\Traits\HasUUidAsPrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory, HasUUidAsPrimary;

    protected $casts = [
        'date' => 'array',
        'date.*' => 'datetime',
        'pets' => 'boolean',
    ];


}
