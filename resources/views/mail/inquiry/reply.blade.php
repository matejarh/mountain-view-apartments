<x-mail::message>
# {{__('Reply on your inquiry')}}

{{__('about')}} **{{ $inquiry->property->title->$lang }}**
{{__('Subject')}} **{{ $inquiry->subject }}**:

![{{$inquiry->property->name}}s {{__('image')}}]({{$inquiry->property->avatar_url}})

<x-mail::table>
| {{__('Arrival Date')}} | {{__('Departure Date')}} |
| :-------------: |:-------------:|
| {{\Carbon\Carbon::parse($inquiry->date[0])->locale($lang)->isoFormat('LLLL')}} | {{\Carbon\Carbon::parse($inquiry->date[0])->locale($lang)->isoFormat('LLLL')}} |
</x-mail::table>

<x-mail::panel>
{!! $reply['text'] !!}
</x-mail::panel>

<x-mail::button :url="route('inquiries.show', [$lang, $inquiry])">
{{__('Show')}}
</x-mail::button>

<x-mail::subcopy>
{{__('Thank you for using')}} **[{{config('app.name')}}<sup>&copy;</sup>]({{config('app.url')}})**!
</x-mail::subcopy>
</x-mail::message>
