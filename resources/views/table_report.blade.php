@extends('layouts.master')

@section('title')
    {!! $page_opts['title_text'] !!}
@endsection

@section('list')
    @if(null !== session('success_message'))
        <div class="success-message">
            <h3>{!! session('success_message') !!}</h3>
        </div>
    @endif

    <div id="list">

        <h3 class="report-header">{!! $page_opts['header_text'] !!}</h3>

        <table>
            <tr>
                @foreach ($table_headers as $ix => $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
            @foreach ($table_data as $pos => $p)
                <tr>
                    @foreach ($table_cols as $ix => $col)
                        <td>{!! $p[$col] !!}</td>
                    @endforeach
                </tr>
            @endforeach

        </table>

        @if($page_opts['back_button'])
            <p class="report-back-link">
                <a href="/find/study/list/{{$page_opts['filter']}}">Back to list</a>
            </p>
        @endif
    </div>

@endsection
