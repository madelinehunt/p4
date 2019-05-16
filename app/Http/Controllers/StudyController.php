<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Participant;
use App\Study;

class StudyController extends Controller
{
    private $validation_rules = [
        'name' => [
            'required',
            'max:56',
            'regex:/\//i',
            'not_regex:/\s/i'
        ],
    ];

    private $validation_messages = [
        'name.max' => 'Name can\'t be that long.',
        'name.regex' => 'The name should have a slash in it.',
        'name.not_regex' => 'The name shouldn\'t have any whitespace in it.',
    ];

    public function addForm()
    {
        return view('create_or_edit')->with([
            'page_opts' => [
                'form_type' => 'study',
                'action_type' => 'add',
                'header_text' => 'Add a study to the database',
                'button_label' => 'Add study',
                'title_text' => 'Add a study to the database',
            ],
        ]);
    }

    public function editForm($id)
    {
        $data = Study::find($id);
        return view('create_or_edit')->with([
            'page_opts' => [
                'form_type' => 'study',
                'action_type' => 'edit',
                'header_text' => 'Edit '.$data->name,
                'button_label' => 'Submit',
                'title_text' => 'Edit '.$data->name,
            ],
            'prefill_data' => $data,
            'id' => $id,
        ]);
    }

    public function addToDB(Request $request)
    {

        $this->validate($request, $this->validation_rules, $this->validation_messages);

        $new_study = new Study();
        $fields = [
            'name',
            'type',
            'accepted',
            'submitted',
            'fund'
        ];
        foreach ($fields as $ix => $field) {
            $new_study[$field] = $request[$field];
        };

        if ($new_study->accepted == null) {
            $new_study->accepted = 0;
        };

        if ($new_study->submitted == null) {
            $new_study->submitted = 0;
        };

        $new_study->save();

        return redirect('/add/study/render')->with([
            'success_message' => 'Study <i>' . $new_study->name . '</i> added to the database!',
            'success_header' => 'Add another study?',
        ]);
    }

    public function updateInDB(Request $request, $id)
    {
        $this->validate($request, $this->validation_rules, $this->validation_messages);

        $udpated_study = Study::find($id);
        $fields = [
            'name',
            'type',
            'accepted',
            'submitted',
            'fund'
        ];

        foreach ($fields as $ix => $field) {
            $udpated_study[$field] = $request[$field];
        };

        $udpated_study->save();

        return redirect('/find/study/list')->with([
            'success_message' => 'Study '.$udpated_study->name.' successfully updated!',
            'success_header' => 'Edit another study?',
        ]);

    }

    public function list($filter = null)
    {
        // can be refactored, I'm sure

        $query = $filter;
        if ($filter == 'fMRI' || $filter == 'mturk') {
            $report_type = 'study_list_read';

            $data = Study::where('type', '=', $filter)->get();

            if ($query == 'mturk') {
                $display_type = 'MTurk';
            } else {
                $display_type = $query;
            };
            $header_message = 'List of '.$display_type.' studies:';

        } else if ($filter === null) {
            $report_type = 'study_list_update';

            $data = Study::all();
        } else if (preg_match('/—/',$filter) == 0) {
            $report_type = 'single_study_report';
            $data = Study::with('participants')->find($query);
        } else {
            $report_type = 'search_results';
            $params = explode('—', $query);
            $data = Participant::with('studies')->where($params[1], $params[2], '%'.$params[3].'%')->get();
            $header_message = 'List of results:';
        }

        if ($report_type == 'study_list_read' || $report_type == 'study_list_update') {

            $pretty_headers = [
                'Fund',
                'Updated At',
                'Number Accepted',
                'Number Submitted',
            ];

            $col_names = [
                'fund',
                'updated_at',
                'accepted',
                'submitted',
            ];

            if ($report_type == 'study_list_read'){
                array_unshift($pretty_headers, 'Name', 'Type');
                array_unshift($col_names, 'name', 'type');
                $link_stub = '<a href="/find/study/list/';
            } else {
                array_unshift($pretty_headers, 'Name');
                array_unshift($col_names, 'name');
                $header_message = 'Choose a study to edit:';
                $link_stub = '<a href="/edit/study/';
            }

            $table_formatted_data = [];

            foreach ($data as $pos => $study) {
                $table_formatted_data[$pos] = [];
                foreach ($col_names as $ix => $col) {
                    if ($col == 'name') {
                        $table_formatted_data[$pos][$col] = $link_stub . $data[$pos]['id'] . '">' . $study[$col] . '</a>';
                    } else {
                        $table_formatted_data[$pos][$col] = $study[$col];
                    }
                };
            };

            $title_text = $header_message;
            $back_button = false;

        } else if ($report_type == 'single_study_report') {
            $pretty_headers = [
                'ID',
                'Age',
                'Gender',
                'Race',
                'Ethnicity',
                'Political Affiliation',
                'Date Run',
            ];

            $col_names = [
                'id_code',
                'age',
                'gender',
                'race',
                'ethnicity',
            ];

            $pivot_col_names = [
                'political_affiliation',
                'date_run'
            ];

            $table_formatted_data = [];

            foreach ($data->participants as $pos => $p) {
                $table_formatted_data[$pos] = [];
                foreach ($col_names as $ix => $col) {
                    $table_formatted_data[$pos][$col] = $p[$col];
                };
                foreach ($pivot_col_names as $ix => $col) {
                    $table_formatted_data[$pos][$col] = $p->pivot[$col];
                };
            };

            array_push($col_names, ...$pivot_col_names);

            $header_message = $data->name;
            $title_text = $header_message;
            $back_button = true;
            $filter = $data->type;
        } else {
            // dd($data);

            $pretty_headers = [
                'ID',
                'type',
                'Age',
                'Gender',
                'Race',
                'Ethnicity',
                'Studies',
            ];

            $col_names = [
                'id_code',
                'type',
                'age',
                'gender',
                'race',
                'ethnicity',
                'studies'
            ];
            if ($params[0] == 'edit') {
                $link_stub = '<a href="/edit/participant/';
            } else {
                $link_stub = '<a href="/edit/connection/';
            }

            $table_formatted_data = [];

            foreach ($data as $pos => $p) {
                $table_formatted_data[$pos] = [];
                foreach ($col_names as $ix => $col) {
                    if ($col != 'studies') {
                        if ($col == 'id_code') {
                            $table_formatted_data[$pos][$col] = $link_stub . $p['id'] . '">' . $p[$col] . '</a>';
                        } else {
                            $table_formatted_data[$pos][$col] = $p[$col];
                        }
                    } else {
                        $table_formatted_data[$pos][$col] = '';
                        foreach ($p->studies as $i => $study) {
                            if ($i == 0) {
                                $table_formatted_data[$pos][$col] .= $study->name;
                            } else {
                                $table_formatted_data[$pos][$col] .= '<br>'.$study->name;
                            }
                        }
                    }
                };
            };

            $title_text = $header_message;
            $back_button = false;
        }

        return view('table_report')->with([
            'table_headers' => $pretty_headers,
            'table_data' => $table_formatted_data,
            'table_cols' => $col_names,
            'page_opts' => [
                'header_text' => $header_message,
                'back_button' => $back_button,
                'title_text' => $title_text,
                'filter' => $filter,
            ],
        ]);
    }


}
