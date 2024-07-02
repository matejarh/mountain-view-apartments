@php
$buttons=[
[
'url' => route('reservations.index', ['lang' => $lang]),
'color' => 'primary',
'align' => 'center',
'text' => 'Show'
],
];
@endphp
<x-mail::message>
# {{__('Your reservation')}}
## {{__('for')}} **{{ $reservation->property->title->$lang }}** {{ __('Has Been Confirmed') }}

<x-mail::panel>
{{ $reservation->message }}

- {{__('Guests')}}: {{ $reservation->guests->adults }}
- {{__('Nights')}}: {{ $reservation->nights }}
- {{__('Price')}}: {{ $reservation->formatted_price }}
</x-mail::panel>

<x-mail::table>
| {{__('Arrival Date')}} | {{__('Departure Date')}} |
| :-------------: |:-------------:|
| {{\Carbon\Carbon::parse($reservation->arrival)->locale($lang)->isoFormat('LLLL')}} | {{\Carbon\Carbon::parse($reservation->departure)->locale($lang)->isoFormat('LLLL')}} |
</x-mail::table>

<x-mail::buttons :buttons="$buttons">
</x-mail::buttons>

<x-mail::subcopy>
{{__('Thank you for using')}} **[{{config('app.name')}}<sup>&copy;</sup>]({{config('app.url')}})**!
</x-mail::subcopy>
</x-mail::message>
