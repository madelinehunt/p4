@extends('layouts.master')

@section('title')
    {{ $page_opts['title_text'] }}
@endsection

@section('create_or_edit_form')
    <div id="create_or_edit_form">

        @if (null !== old('id_code') || null !== old('fund'))
            @php
                $fill_source = 'old';
            @endphp
        @elseif (isset($prefill_data))
            @php
                $fill_source = 'db_data';
            @endphp
        @else
            @php
                $fill_source = 'none';
            @endphp
        @endif

        @if(null !== session('success_message'))
            <div class="success-message">
                <h3>{!! session('success_message') !!}</h3>
            </div>
        @endif

        @if(null !== session('success_header'))
            <h3>{!! session('success_header') !!}</h3>
        @else
            <h3>{{ $page_opts['header_text'] }}</h3>
        @endif

        @if ($page_opts['form_type'] == 'study')
            @include('form.study', [
                'button_label' => $page_opts['button_label'],
                'action_type' => ($page_opts['action_type'] == 'add') ? 'add' : 'update',
                'url_final_section' => ($page_opts['action_type'] == 'add') ? 'create' : ''
            ])
        @elseif ($page_opts['form_type'] == 'connection')
            @include('form.connection', [
                'button_label' => $page_opts['button_label'],
                'action_type' => $page_opts['action_type'],
                'url_final_section' => ($page_opts['action_type'] == 'add') ? 'create' : 'update'
            ])
        @else
            @include('form.participant', [
                'button_label' => $page_opts['button_label'],
                'action_type' => ($page_opts['action_type'] == 'add') ? 'add' : 'update',
                'url_final_section' => ($page_opts['action_type'] == 'add') ? 'create' : ''
            ])
        @endif
    </div>
    <div id="req-explanation">@include('snippets.req') required</div>

@endsection
