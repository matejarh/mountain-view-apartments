<x-mail::message>
# {{__('New inquiry from')}} {{ $inquiry->name }}

{{__('for')}} **{{ $inquiry->property->title->$lang }}** {{__('received')}}:
![{{$inquiry->property->name}}s {{__('image')}}]({{$inquiry->property->avatar_url}})
<x-mail::panel>
## {{ str($inquiry->subject)->title() }}

{{ $inquiry->message }}

- {{__('Adults')}}: {{$inquiry->adults}}
- {{__('Children')}}: {{$inquiry->adults}}
- {{__('Pets')}}: {{$inquiry->pets ? 'Yes' : 'No'}}
</x-mail::panel>

<x-mail::table>


| {{__('Arrival Date')}} | {{__('Departure Date')}} |
| :-------------: |:-------------:|
| {{\Carbon\Carbon::parse($inquiry->date[0])->locale($lang)->toDateString()}} | {{\Carbon\Carbon::parse($inquiry->date[0])->locale($lang)->toDateString()}} |

</x-mail::table>

<x-mail::button :url="route('admin.inquiries.show', $inquiry)">
{{__('Show')}}
</x-mail::button>

<x-mail::subcopy>
{{__('Thank you for using')}} **[{{config('app.name')}}<sup>&copy;</sup>]({{config('app.url')}})**!
</x-mail::subcopy>
</x-mail::message>
