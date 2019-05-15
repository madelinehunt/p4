@extends('layouts.master')

@section('title')
    Edit a participant
@endsection

@section('update-form')

    <h3>Editing <i>{{ $existing_participant->id_code }}</i></h3>

        <form method='POST' action='/participant/updateInDB/{{$participant_id}}' class="creation-form">
            {{ csrf_field() }}
            {{-- this is a bit hacky, but it allows me to use either data flashed to session or an existing study --}}
            @if(null !== old('id_code'))
                @php
                    function fill($param, $ignore)
                    {
                        return old($param);
                    };
                    $existing_participant = null;
                @endphp
            @else
                @php
                    function fill($param, $existing_participant)
                    {
                        return $existing_participant[$param];
                    };
                @endphp
            @endif

            <label for='id_code'>ID @include('snippets.req')</label>
            <input type='text' name='id_code' value='{{ fill('id_code', $existing_participant) }}'>
            @include('snippets.error', ['field_name' => 'id_code'])

            <label for='type'>Participant Type @include('snippets.req')</label>
            <select name='type' required>
                <option value='' disabled selected>Choose one…</option>
                    <option value='mturk' {{ (fill('type', $existing_participant) == 'mturk') ? 'selected' : '' }}>MTurk</option>
                    <option value='fMRI' {{ (fill('type', $existing_participant) == 'fMRI') ? 'selected' : '' }}>Local (fMRI)</option>
            </select>

            <label for='age'>Age @include('snippets.req')</label>
            <input type='text' name='age' pattern="[0-9]+" value='{{ fill('age', $existing_participant) }}'>
            @include('snippets.error', ['field_name' => 'age'])
            {{-- `pattern` restricts to numbers only --}}

            <label for='gender'>Gender @include('snippets.req')</label>
            <select name='gender' required>
                <option value='' disabled selected>Choose one…</option>
                @foreach ($gender_choices as $ix => $choice)
                    <option value='{{ $choice }}' {{ (fill('gender', $existing_participant) == $choice) ? 'selected' : '' }} >{{ $choice }}</option>
                @endforeach
            </select>

            <label for='race'>Race @include('snippets.req')</label>
            <select name='race' required>
                <option value='' disabled selected>Choose one…</option>
                @foreach ($race_choices as $ix => $choice)
                    <option value='{{ $choice }}' {{ (fill('race', $existing_participant) == $choice) ? 'selected' : '' }}>{{ $choice }}</option>
                @endforeach
            </select>

            <label for='ethnicity'>Ethnicity @include('snippets.req')</label>
            <select name='ethnicity' required>
                <option value='' disabled selected>Choose one…</option>
                @foreach ($ethn_choices as $ix => $choice)
                    <option value='{{ $choice }}' {{ (fill('ethnicity', $existing_participant) == $choice) ? 'selected' : '' }}>{{ $choice }}</option>
                @endforeach
            </select>

            <input type='submit' class='submit-button' value='Update participant'>
        </form>

        <div id="req-explanation">@include('snippets.req') required</div>

@endsection
