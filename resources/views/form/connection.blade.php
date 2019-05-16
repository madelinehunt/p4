<form method='POST' action='/update/connection/{{ $p_id }}'>
    {{ csrf_field() }}
    <table>
        <tr>
            <th>ID @include('snippets/req')</th>
            <th>Study @include('snippets/req')</th>
            <th>Political Affiliation</th>
            <th>Date Run</th>
        </tr>
            <tr>
                <td>
                    {{ $participant->id_code }}
                </td>
                <td>
                    <select name='study_add' required class="table-select-input">
                        <option value='' disabled selected>Choose one…</option>
                        @foreach ($studies as $ix => $study)
                            <option value='{{ $study->id }}'>{{ $study->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name='political_affiliation' class="table-select-input">
                        <option value='' disabled selected>Optional</option>
                        @foreach ($pol_options as $ix => $opt)
                            <option value='{{ $opt }}'>{{ $opt }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type='date' name='date_run' class="table-date-input">
                </td>
            </tr>
    </table>
    <input type='submit' class='submit-button' value='Submit'>
</form>
