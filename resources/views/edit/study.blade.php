@extends('layouts.master')

@section('title')
    Edit a study
@endsection

@section('update-form')

    <h3>Editing <i>{{ $existing_study->name }}</i></h3>

        <form method='POST' action='/study/updateInDB/{{$study_id}}' class="creation-form">
            {{ csrf_field() }}

            {{-- this is a bit hacky, but it allows me to use either data flashed to session or an existing study --}}
            @if(null !== old('name'))
                @php
                    function fill($param, $ignore)
                    {
                        return old($param);
                    };
                    $existing_study = null;
                @endphp
            @else
                @php
                    function fill($param, $existing_study)
                    {
                        return $existing_study[$param];
                    };
                @endphp
            @endif

            <label for='name'>Name @include('snippets.req')</label>
            <input type='text' name='name' id='study-name' value="{{ fill('name', $existing_study) }}">
            @include('snippets.error', ['field_name' => 'name'])

            <label for='type'>Study Type @include('snippets.req')</label>
            <select name='type' required>
                <option value='' disabled selected>Choose one…</option>
                    <option value='mturk' {{ (fill('type', $existing_study) == 'mturk') ? 'selected' : '' }}>MTurk</option>
                    <option value='fMRI' {{ (fill('type', $existing_study) == 'fMRI') ? 'selected' : '' }}>Local (fMRI)</option>
            </select>

            <label for='fund'>Fund @include('snippets.req')</label>
            <select name='fund' required>
                <option value='' disabled selected>Choose one…</option>
                    <option value='National Science Foundation' {{ (fill('fund', $existing_study) == 'National Science Foundation') ? 'selected' : '' }}>National Science Foundation</option>
                    <option value='Harvard-Funded' {{ (fill('fund', $existing_study) == 'Harvard-Funded') ? 'selected' : '' }}>Harvard-Funded</option>
            </select>

            <label for='accepted'># of participants accepted? <i>(if applicable)</i></label>
            <input type='text' name='accepted' pattern="[0-9]+" value='{{ fill('accepted', $existing_study) }}'>
            {{-- `pattern` restricts to numbers only --}}

            <label for='submitted'># of participants submitted? <i>(if applicable)</i></label>
            <input type='text' name='submitted' pattern="[0-9]+" value='{{ fill('accepted', $existing_study) }}'>
            {{-- `pattern` restricts to numbers only --}}

            <input type='submit' class='submit-button' value='Update study'>
        </form>

        <div id="req-explanation">@include('snippets.req') required</div>

@endsection
