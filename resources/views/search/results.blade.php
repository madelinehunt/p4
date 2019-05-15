@extends('layouts.master')

@section('title')

    List of results

@endsection

@section('list')

    <h3 class="list-header">List of results:</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Race</th>
            <th>Ethnicity</th>
            <th>Studies</th>
        </tr>
        @foreach ($results as $ix => $result)
            <tr>
                <td>
                    <a href="/{{ $req_type }}/participant/{{ $result->id }}">
                        {{ $result->id_code }}
                    </a>
                </td> {{-- add link here --}}
                <td>{{ $result->type }}</td>
                <td>{{ $result->age }}</td>
                <td>{{ $result->gender }}</td>
                <td>{{ $result->race }}</td>
                <td>{{ $result->ethnicity }}</td>
                <td>
                    @foreach ($result->studies as $key => $study)
                        {{ $study->name }}<br/>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>

@endsection
