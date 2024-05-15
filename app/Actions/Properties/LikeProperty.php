<?php

namespace App\Actions\Properties;

use App\Contracts\LikesProperties;
use App\Models\Property;

class LikeProperty implements LikesProperties
{
    /**
     * Likes given property
     *
     * @param  \App\Models\Property  $property
     */
    public function like( Property $property): void
    {
        $property->like();
        $locale = app()->currentLocale();
        session()->flash('flash.banner', __('You like '.$property->title->$locale.'.'));
    }
}
