@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ Vite::asset('resources/images/logolight.png') }}" class="logo" alt="{{ config('app.name')}} Logo">
{{-- <img src="{{ Vite::asset('resources/images/logodark.png') }}" class="logo-dark" alt="{{ config('app.name')}} Logo"> --}}
{{-- {{ $slot }} --}}
@endif
</a>
</td>
</tr>
