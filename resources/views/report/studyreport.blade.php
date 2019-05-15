@extends('layouts.master')

@section('title')
    {{ $study->name }} report
@endsection

@section('report')

    <h3 class="report-header">{{ $study->name }}</h3>

    <table>
        <tr>
            <th>ID</th>
            {{-- <th>Type</th> --}}
            <th>Age</th>
            <th>Gender</th>
            <th>Race</th>
            <th>Ethnicity</th>
            <th>Political Affiliation</th>
            <th>Date Run</th>
        </tr>
        @foreach ($study->participants as $ix => $p)
            <tr>
                <td>{{ $p->id_code }}</td>
                {{-- <td>{{ $p->type }}</td> --}}
                <td>{{ $p->age }}</td>
                <td>{{ $p->gender }}</td>
                <td>{{ $p->race }}</td>
                <td>{{ $p->ethnicity }}</td>
                <td>{{ $p->pivot->political_affiliation }}</td>
                <td>{{ $p->pivot->date_run }}</td>
            </tr>
        @endforeach

    </table>

    <p class="report-back-link">
        <a href="/report/{{$study->type}}">Back to list</a>
    </p>

@endsection
