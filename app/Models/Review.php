<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Model
{
    use RecordsActivity;

    public function reviewed()
    {
        return $this->MorphTo();
    }
}
