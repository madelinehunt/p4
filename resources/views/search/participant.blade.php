@extends('layouts.master')

@section('title')
    Find a participant to edit.
@endsection

@section('update-form')

    @if(null !== session('edited_name'))
        <div class="add-success">
            <h3>Participant <i>{{ session('edited_name') }}</i> successfully updated!</h3>
        </div>
    @endif


    <h3>Find a participant to edit.</h3>

        <form method='GET' action='/find/participant/search' class="creation-form">
            {{ csrf_field() }}

            <label for='keyword'>Substring search of ID field @include('snippets.req')</label>
            <input type='text' name='keyword' value='{{ old('keyword') }}'>
            @include('snippets.error', ['field_name' => 'keyword'])

            <input type='submit' class='submit-button' value='Search'>
        </form>

        <div id="req-explanation">@include('snippets.req') required</div>

@endsection
