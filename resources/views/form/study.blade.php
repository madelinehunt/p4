<form method='POST' action='/{{ $action_type }}/study/{{ $url_final_section }}{{ (isset($id)) ? $id : ''  }}' class="add_or_edit_form">
    {{ csrf_field() }}

    <label for='name'>Name @include('snippets.req') <i>(format is: "initals/experiment")</i></label>
    <input type='text' name='name' id="name" value=@include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'text', 'param' => 'name'])>
    @include('snippets.error', ['field_name' => 'name'])

    <label for='type'>Study Type @include('snippets.req')</label>
    <select name='type' id="type" required>
        <option value='' disabled selected>Choose one…</option>
            <option value='mturk' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'type', 'choice'=>'mturk'])>MTurk</option>
            <option value='fMRI' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'type', 'choice'=>'fMRI'])>Local (fMRI)</option>
    </select>

    <label for='fund'>Fund @include('snippets.req')</label>
    <select name='fund' id="fund" required>
        <option value='' disabled selected>Choose one…</option>
            <option value='National Science Foundation' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'fund', 'choice'=>'National Science Foundation'])>National Science Foundation</option>
            <option value='Harvard-Funded' @include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'select', 'param'=>'fund', 'choice'=>'Harvard-Funded'])>Harvard-Funded</option>
    </select>

    <label for='accepted'># of participants accepted? <i>(if applicable)</i></label>
    <input type='text' name='accepted' pattern="[0-9]+" value=@include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'text', 'param' => 'accepted']) id="accepted">
    {{-- `pattern` restricts to numbers only --}}

    <label for='submitted'># of participants submitted? <i>(if applicable)</i></label>
    <input type='text' name='submitted' pattern="[0-9]+" value=@include('snippets.prefill', ['fill_source'=>$fill_source, 'type'=>'text', 'param' => 'submitted']) id="submitted">
    {{-- `pattern` restricts to numbers only --}}

    <input type='submit' class='submit-button' value='{{ $button_label }}'>
</form>
