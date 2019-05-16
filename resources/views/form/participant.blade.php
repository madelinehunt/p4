<form method='POST' action='/{{ $action_type }}/participant/{{ $url_final_section }}{{ (isset($id)) ? $id : ''  }}' class="add_or_edit_form">
    {{ csrf_field() }}

    <label for='id_code'>ID @include('snippets.req')</label>
    <input type='text' name='id_code' value=@include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'text', 'param' => 'id_code']) id="id_code">
    @include('snippets.error', ['field_name' => 'id_code'])

    <label for='type'>Participant Type @include('snippets.req')</label>
    <select name='type' required id="type">
        <option value='' disabled selected>Choose one…</option>
            <option value='mturk' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'type', 'choice'=>'mturk'])> MTurk</option>
            <option value='fMRI' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'type', 'choice'=>'fMRI'])>Local (fMRI)</option>
    </select>

    <label for='age'>Age @include('snippets.req')</label>
    <input type='text' name='age' pattern="[0-9]+" value=@include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'text', 'param' => 'age']) id="age">
    @include('snippets.error', ['field_name' => 'age'])
    {{-- `pattern` restricts to numbers only --}}

    <label for='gender'>Gender @include('snippets.req')</label>
    <select name='gender' required id="gender">
        <option value='' disabled selected>Choose one…</option>
        @foreach ($gender_choices as $ix => $choice)
            <option value='{{ $choice }}' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'gender', 'choice'=>$choice])>{{ $choice }}</option>
        @endforeach
    </select>

    <label for='race'>Race @include('snippets.req')</label>
    <select name='race' required id="race">
        <option value='' disabled selected>Choose one…</option>
        @foreach ($race_choices as $ix => $choice)
            <option value='{{ $choice }}' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'race', 'choice'=>$choice])>{{ $choice }}</option>
        @endforeach
    </select>

    <label for='ethnicity'>Ethnicity @include('snippets.req')</label>
    <select name='ethnicity' required id="ethnicity">
        <option value='' disabled selected>Choose one…</option>
        @foreach ($ethn_choices as $ix => $choice)
            <option value='{{ $choice }}' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'ethnicity', 'choice'=>$choice])>{{ $choice }}</option>
        @endforeach
    </select>

    <input type='submit' class='submit-button' value='{{ $button_label }}'>
</form>
