<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    use RecordsActivity;


    // protected $with = ['liked'];

    public function liked()
    {
        return $this->MorphTo();
    }
}
