@extends('layouts.master')

@section('list')
    <h3 class="list-header">List of {{ $study_type }} studies:</h3>


    <table>
        <tr>
            <th>Name</th>
            <th>Fund</th>
            <th>Updated At</th>
            <th>Number Accepted</th>
            <th>Number Submitted</th>
        </tr>
        @foreach ($study_list as $ix => $study)

            <tr>
                <td>
                    <a href="/studies/show/{{$study->id}}">{{ $study->name }}</a>
                </td>
                <td>{{ $study->fund }}</td>
                <td>{{ $study->updated_at }}</td>
                <td>{{ $study->accepted }}</td>
                <td>{{ $study->submitted }}</td>
            </tr>
        @endforeach
    </table>


@endsection
