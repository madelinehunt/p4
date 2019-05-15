@extends('layouts.master')

@section('title')
    Add a participant to the database
@endsection

@section('update-form')
    @if(null !== session('new_participant'))
        <div class="add-success">
            <h3>Participant <i>{{ session('new_participant')->id_code }}</i> added to the database!</h3>
        </div>
    @endif

    @if(null !== session('new_participant'))
        <h3>Add another participant to the database?</h3>
    @else
        <h3>Add a participant to the database</h3>
    @endif

        <form method='POST' action='/participant/addToDB' class="creation-form">
            {{ csrf_field() }}

            <label for='id_code'>ID @include('snippets.req')</label>
            <input type='text' name='id_code' value='{{ old('id_code') }}'>
            @include('snippets.error', ['field_name' => 'id_code'])

            <label for='type'>Participant Type @include('snippets.req')</label>
            <select name='type' required>
                <option value='' disabled selected>Choose one…</option>
                    <option value='mturk' {{ (old('type') == 'mturk') ? 'selected' : '' }}>MTurk</option>
                    <option value='fMRI' {{ (old('type') == 'fMRI') ? 'selected' : '' }}>Local (fMRI)</option>
            </select>

            <label for='age'>Age @include('snippets.req')</label>
            <input type='text' name='age' pattern="[0-9]+" value='{{ old('age') }}'>
            @include('snippets.error', ['field_name' => 'age'])
            {{-- `pattern` restricts to numbers only --}}

            <label for='gender'>Gender @include('snippets.req')</label>
            <select name='gender' required>
                <option value='' disabled selected>Choose one…</option>
                @foreach ($gender_choices as $ix => $choice)
                    <option value='{{ $choice }}' {{ (old('gender') == $choice) ? 'selected' : '' }} >{{ $choice }}</option>
                @endforeach
            </select>

            <label for='race'>Race @include('snippets.req')</label>
            <select name='race' required>
                <option value='' disabled selected>Choose one…</option>
                @foreach ($race_choices as $ix => $choice)
                    <option value='{{ $choice }}' {{ (old('race') == $choice) ? 'selected' : '' }}>{{ $choice }}</option>
                @endforeach
            </select>

            <label for='ethnicity'>Ethnicity @include('snippets.req')</label>
            <select name='ethnicity' required>
                <option value='' disabled selected>Choose one…</option>
                @foreach ($ethn_choices as $ix => $choice)
                    <option value='{{ $choice }}' {{ (old('ethnicity') == $choice) ? 'selected' : '' }}>{{ $choice }}</option>
                @endforeach
            </select>

            <input type='submit' class='submit-button' value='Add participant'>
        </form>

        <div id="req-explanation">@include('snippets.req') required</div>

@endsection
