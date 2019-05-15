@extends('layouts.master')

@section('title')
    Add a study to the database
@endsection

@section('update-form')
    @if(null !== session('new_study'))
        <div class="add-success">
            <h3>Study <i>{{ session('new_study')->name }}</i> added to the database!</h3>
        </div>
    @endif

    @if(null !== session('new_study'))
        <h3>Add another study to the database?</h3>
    @else
        <h3>Add a study to the database</h3>
    @endif

        <form method='POST' action='/study/addToDB' class="creation-form">
            {{ csrf_field() }}

            <label for='name'>Name @include('snippets.req') <i>(format is: "initals/experiment")</i></label>
            <input type='text' name='name' id='name' value=''>
            @include('snippets.error', ['field_name' => 'name'])

            <label for='type'>Study Type @include('snippets.req')</label>
            <select name='type' id="type" required>
                <option value='' disabled selected>Choose one…</option>
                    <option value='mturk' {{ (old('type') == 'mturk') ? 'selected' : '' }}>MTurk</option>
                    <option value='fMRI' {{ (old('type') == 'fMRI') ? 'selected' : '' }}>Local (fMRI)</option>
            </select>

            <label for='fund'>Fund @include('snippets.req')</label>
            <select name='fund' id="fund" required>
                <option value='' disabled selected>Choose one…</option>
                    <option value='National Science Foundation' {{ (old('fund') == 'National Science Foundation') ? 'selected' : '' }}>National Science Foundation</option>
                    <option value='Harvard-Funded' {{ (old('fund') == 'Harvard-Funded') ? 'selected' : '' }}>Harvard-Funded</option>
            </select>

            <label for='accepted'># of participants accepted? <i>(if applicable)</i></label>
            <input type='text' name='accepted' pattern="[0-9]+" value='' id="accepted">
            {{-- `pattern` restricts to numbers only --}}

            <label for='submitted'># of participants submitted? <i>(if applicable)</i></label>
            <input type='text' name='submitted' pattern="[0-9]+" value='' id="submitted">
            {{-- `pattern` restricts to numbers only --}}

            <input type='submit' class='submit-button' value='Add study'>
        </form>

        <div id="req-explanation">@include('snippets.req') required</div>

@endsection
