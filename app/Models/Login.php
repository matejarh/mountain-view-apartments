<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use RecordsActivity;

    protected $casts = [
        'location' => 'object',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
