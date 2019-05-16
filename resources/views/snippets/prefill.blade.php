{{-- this is a bit hacky, but it allows me to use either data flashed to session or an existing study --}}
@if ($fill_source == 'old')
    @if ($type == 'text') {{-- text inputs --}}
        "{{ old($param) }}"
    @else {{-- select inputs --}}
        {{ ( old($param) == $choice) ? 'selected' : '' }}
    @endif
@elseif ($fill_source == 'db_data')
    @if ($type == 'text') {{-- text inputs --}}
        "{{ $prefill_data[$param] }}"
    @else {{-- select inputs --}}
        {{ ($prefill_data[$param] == $choice) ? 'selected' : '' }}
    @endif
@else
    ""
@endif
