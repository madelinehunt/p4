@extends('layouts.master')

@section('report')

    <h3 class="report-header">{{ $study->name }}</h3>


    <table>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Race</th>
            <th>Ethnicity</th>
        </tr>
        @foreach ($study->participants as $ix => $p)
            <tr>
                <td>{{ $p->id_code }}</td>
                <td>{{ $p->participant_type }}</td>
                <td>{{ $p->age }}</td>
                <td>{{ $p->gender }}</td>
                <td>{{ $p->race }}</td>
                <td>{{ $p->ethnicity }}</td>
            </tr>
        @endforeach
    </table>

    <p class="report-back-link">
        <a href="/report/{{$study->type}}">Back to list</a>
    </p>

@endsection
