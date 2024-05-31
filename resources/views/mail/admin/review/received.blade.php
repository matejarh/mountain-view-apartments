@php
$buttons = [
    [
        'url' => route('admin.reviews.show', ['review' => $review, 'approve' => true]),
        'color' => 'green',
        'align' => 'left',
        'text' => 'Approve'
    ],
    [
        'url' => route('admin.reviews.show', ['review' => $review, 'reject' => true]),
        'color' => 'red',
        'align' => 'center',
        'text' => 'Reject'
    ],
    [
        'url' => route('admin.reviews.show', ['review' => $review]),
        'color' => 'primary',
        'align' => 'right',
        'text' => 'Show'
    ],
];
@endphp
<x-mail::message>
# {{__('New review for')}} {{ $review->reviewed_trimed[0]['title']->$lang }}

{{__('from')}} **{{ $review->owner->name }}**:

![{{$review->reviewed_trimed[0]['title']->$lang}}s {{__('image')}}]({{$review->reviewed_trimed[0]['avatar_url']}})

## {{__('Score')}}: {{$review->score}}
## {{__('Content')}}:

<x-mail::panel>
{!! $review->text !!}
</x-mail::panel>

<x-mail::buttons :buttons="$buttons">
</x-mail::buttons>

<x-mail::subcopy>
{{__('Thank you for using')}} **[{{config('app.name')}}<sup>&copy;</sup>]({{config('app.url')}})**!
</x-mail::subcopy>
</x-mail::message>
