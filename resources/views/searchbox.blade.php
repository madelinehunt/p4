@extends('layouts.master')

@section('title')
    @if ($edit_type == 'edit')
        Find a participant to edit
    @else
        Add a participant to a study
    @endif
@endsection

@section('create_or_edit_form')

    @if(null !== session('success_message'))
        <div class="success-message">
            <h3>{!! session('success_message') !!}</h3>
        </div>
    @endif

    <h3>
        @if(null !== session('success_header'))
            <h3>{!! session('success_header') !!}</h3>
        @else
            @if ($edit_type == 'edit')
                Find a participant to edit:
            @else
                Add a participant to a study:
            @endif
        @endif

    </h3>

        <form method='GET' action='/find/searchEngine/{{ $edit_type }}' class="add_or_edit_form">
            {{ csrf_field() }}

            <label for='keyword'>Substring search of ID field @include('snippets.req')</label>
            <input type='text' name='keyword' value='{{ old('keyword') }}'>
            @include('snippets.error', ['field_name' => 'keyword'])

            <input type='submit' class='submit-button' value='Search'>
        </form>

        <div id="req-explanation">@include('snippets.req') required</div>

@endsection
