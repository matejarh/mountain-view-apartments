<?php

namespace App\Actions\Reviews;

use App\Models\Review;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesReviews;


class UpdateReview implements UpdatesReviews
{
    /**
     * Validate and update given review.
     *
     * @param  \App\Models\Review  $review
     * @param  array<string, string>  $input
     */
    public function update(Review $review, array $input): void
    {

        $validator = Validator::make($input, [
            'score' => ['required', 'integer', 'max:5', 'min:1'] ,
            'text' => ['required', 'string', 'min:5', 'max:100', new SpamFree, 'unique:reviews'],
        ]);

        //dd($validator);

        $validator->validateWithBag('updatingReview');

        if (isset($input['approved']) && isset($input['approved']) === 1) {
            $review->approved_at = now();
        }

        if (isset($input['approved']) && isset($input['approved']) === 0) {
            $review->approved_at = null;
        }

        $review->forceFill([
            'score' => $input['score'],
            'text' => $input['text'],
        ])->save();

        session()->flash('flash.banner', __('Review has been updated.'));
    }
}
