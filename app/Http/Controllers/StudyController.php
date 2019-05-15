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


    public function show($id)
    {
        $study = Study::with('participants')->find($id);

        // first show study info as context
        // then show all the participants in the study

        return view('report.studyreport')->with([
            'study' => $study
        ]);
    }

    public function list($type)
    {
        $study = Study::where('type', '=', $type)->get();

        if ($type == 'mturk') {
            $display_type = 'MTurk';
        } else {
            $display_type = $type;
        }

        return view('report.list')->with([
            'study_list' => $study,
            'study_type' => $display_type,
        ]);
    }

    public function create(){
        return view('create.study');
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

        return redirect('/create/study')->with([
            'new_study' => $new_study,
        ]);
    }

    public function findToEdit()
    {
        $studies = Study::all();

        return view('report.list')->with([
            'study_list' => $studies,
        ]);
    }

    public function edit($id)
    {
        $study = Study::find($id);

        return view('edit.study')->with(['existing_study' => $study, 'study_id' => $id]);
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

        return redirect('/edit/study')->with([
            'edited_name' => $udpated_study->name,
        ]);

    }

}
