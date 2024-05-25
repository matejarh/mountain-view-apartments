@props([
    'align' => 'center',
    'buttons' => [
        [
            'url',
            'color' => 'primary',
            'align' => 'center',
            'text' => 'Button Text'
        ]
    ]
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="4" cellspacing="0" role="presentation">
<tr>
@foreach ($buttons as $button)
<td align="{{ $button['align'] }}">
<a href="{{ $button['url'] }}" class="button button-{{ $button['color'] }}" target="_blank" rel="noopener">{{ __($button['text']) }}</a>
</td>
@endforeach
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
