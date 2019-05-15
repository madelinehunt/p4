@extends('layouts.master')

@section('title')
    @isset($study_type)
        List of {{ $study_type }} studies
    @else
        List of studies
    @endisset

@endsection

@section('list')
    @if(null !== session('edited_name'))
        <div class="add-success">
            <h3>Study <i>{{ session('edited_name') }}</i> updated!</h3>
        </div>
    @endif
    
    @isset($study_type)
        <h3 class="list-header">List of {{ $study_type }} studies:</h3>
    @else
        <h3 class="list-header">List of studies:</h3>
    @endisset

    <table>
        <tr>
            <th>Name</th>
            @if(!isset($study_type))
                <th>Type</th>
            @endif
            <th>Fund</th>
            <th>Updated At</th>
            <th>Number Accepted</th>
            <th>Number Submitted</th>
        </tr>
        @foreach ($study_list as $ix => $study)
            @isset($study_type)
                @php ($link = '/studies/show/'.$study->id)
            @else
                @php ($link = '/edit/study/'.$study->id)
            @endisset
            <tr>
                <td>
                    <a href="{{ $link }}">{{ $study->name }}</a>
                </td>
                @if(!isset($study_type))
                    <td>{{ $study->type }}</td>
                @endif
                <td>{{ $study->fund }}</td>
                <td>{{ $study->updated_at }}</td>
                <td>{{ $study->accepted }}</td>
                <td>{{ $study->submitted }}</td>
            </tr>
        @endforeach
    </table>


@endsection
