@foreach ($buttons as $button)
{{ $slot }}: {{ $button['url'] }}
@endforeach
