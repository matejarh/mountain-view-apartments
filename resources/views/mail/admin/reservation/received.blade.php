<x-mail::message>
# {{__('New reservation from')}} {{ $reservation->user->name }}

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

<x-mail::subcopy>
{{__('Thank you for using')}} **[{{config('app.name')}}<sup>&copy;</sup>]({{config('app.url')}})**!
</x-mail::subcopy>
</x-mail::message>
