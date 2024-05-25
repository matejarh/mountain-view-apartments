@php
$buttons=[
[
'url' => route('admin.reservations.show', ['reservation' => $reservation, 'confirm' => true]),
'color' => 'green',
'align' => 'left',
'text' => 'Confirm'
],
[
'url' => route('admin.reservations.show', ['reservation' => $reservation, 'reject' => true]),
'color' => 'red',
'align' => 'center',
'text' => 'Reject'
],
[
'url' => route('admin.reservations.show', ['reservation' => $reservation]),
'color' => 'primary',
'align' => 'right',
'text' => 'Show'
],
];
@endphp
<x-mail::message>
# {{__('New reservation')}} {{__('from')}} {{ $reservation->owner->name }}
## {{__('for')}} **{{ $reservation->property->title->$lang }}**

<x-mail::panel>
{{ $reservation->message }}

- {{__('Adults')}}: {{$reservation->guests->adults}}
- {{__('Children')}}: {{$reservation->guests->children}}
- {{__('Pets')}}: {{$reservation->guests->pets ? __('Yes') : __('No')}}
</x-mail::panel>

<x-mail::table>
| {{__('Arrival Date')}} | {{__('Departure Date')}} |
| :-------------: |:-------------:|
| {{\Carbon\Carbon::parse($reservation->arrival)->locale($lang)->isoFormat('LLLL')}} | {{\Carbon\Carbon::parse($reservation->departure)->locale($lang)->isoFormat('LLLL')}} |
</x-mail::table>

<x-mail::buttons :buttons="$buttons">
</x-mail::button>

<x-mail::subcopy>
{{__('Thank you for using')}} **[{{config('app.name')}}<sup>&copy;</sup>]({{config('app.url')}})**!
</x-mail::subcopy>
</x-mail::message>
