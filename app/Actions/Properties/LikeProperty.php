<?php

namespace App\Actions\Properties;

use App\Contracts\LikesProperties;
use App\Models\Property;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Validator;

class LikeProperty implements LikesProperties
{
    /**
     * Likes given property
     *
     * @param  \App\Models\Property  $property
     */
    public function like( Property $property, array $input): void
    {
        $rules = [
            'captcha_token' => [new Recaptcha],
        ];
        $validator = Validator::make($input, $rules);

        $validator->validate();

        $property->like();
    }
}
