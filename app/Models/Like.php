<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use HasFactory;

    use RecordsActivity;


    //protected $with = ['liked'];

    protected $appends = [
        'liked_trimed',
    ];

    public function liked(): MorphTo
    {
        return $this->MorphTo();
    }

    public function likedTrimed(): Collection
    {
        return $this->liked()->get()->map(function($liked) {
            return [
                'name' => $liked->name ?: '',
                'slug' => $liked->slug ?: '',
                'title' => $liked->title ?: '',
            ];
        });
    }

    function getLikedTrimedAttribute() : Collection {
        return $this->likedTrimed();
    }
}
