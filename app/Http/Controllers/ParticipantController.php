<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Study;
use Carbon\Carbon;

class ParticipantController extends Controller
{
    private $gender_choices = [
        'Male',
        'Female',
        'Non-binary',
        'Decline'
    ];
    private $race_choices = [
        'American Indian or Alaska Native',
        'Asian',
        'Black or African-American',
        'Native Hawaiian or Other Pacific Islander',
        'White',
        'Other',
        'Multi-ethnic',
        'Decline',
    ];
    private $ethn_choices = [
        'Hispanic',
        'Not Hispanic',
        'Decline',
    ];

    private $validation_rules = [
        'id_code' => [
            'required',
            'alpha_num',
            'max:16'
        ],
        'age' => [
            'required',
            'max:120',
            'numeric',
            'min:18'
        ]
    ];

    private $validation_messages = [
        'id_code.required' => 'ID is required.',
        'id_code.alpha_num' => 'ID must be letters and/or numbers only.',
        'id_code.max' => 'ID can\'t be that long.',
        'age.required' => 'Age is required.',
        'age.max' => 'They can\'t possibly be that old.',
        'age.numeric' => 'Age must be a number.',
        'age.min' => 'Participant must be of legal age to consent to the experiment.',
    ];

    public function addForm()
    {
        return view('create_or_edit')->with([
             'page_opts' => [
                 'form_type' => 'participant',
                 'action_type' => 'add',
                 'header_text' => 'Add a participant to the database',
                 'button_label' => 'Add participant',
                 'title_text' => 'Add a participant to the database',
             ],
            'gender_choices' => $this->gender_choices,
            'race_choices' => $this->race_choices,
            'ethn_choices' => $this->ethn_choices,
         ]);
    }

    public function create(){
        return view('create.participant')->with([
            'gender_choices' => $this->gender_choices,
            'race_choices' => $this->race_choices,
            'ethn_choices' => $this->ethn_choices,
        ]);
    }

    public function addToDB(Request $request)
    {
        $this->validate($request, $this->validation_rules, $this->validation_messages);

        $new_participant = new Participant();
        $fields = [
            'type',
            'gender',
            'race',
            'ethnicity',
            'age'
        ];
        foreach ($fields as $ix => $field) {
            $new_participant[$field] = $request[$field];
        };

        $new_participant['id_code'] = strtoupper($request['id_code']);

        $new_participant->save();

        return redirect('/add/participant/render')->with([
            'success_message' => 'Participant '.$new_participant->id_code.'  added to the database!',
            'success_header' => 'Create another participant?',
        ]);
    }

    public function searchPage($edit_type)
    {
        return view('searchbox')->with([
            'edit_type' => $edit_type,
        ]);
    }

    public function searchEngine(Request $request, $req_type)
    {
        $query_string = $req_type.'—'.'id_code'.'—'.'LIKE'.'—'.$request->keyword;

        return redirect('/find/study/list/'.$query_string);
    }

    public function editForm($id)
    {
        $edit_type = explode('/', url()->current());
        $edit_type = $edit_type[sizeof($edit_type)-2]; // derives either connection or participant

        if ($edit_type == 'participant') {
            $data = Participant::find($id);
            return view('create_or_edit')->with([
                 'page_opts' => [
                     'form_type' => 'participant',
                     'action_type' => 'edit',
                     'header_text' => 'Edit '.$data->id_code,
                      'button_label' => 'Submit',
                      'title_text' => 'Edit '.$data->id_code,
                 ],
                'gender_choices' => $this->gender_choices,
                'race_choices' => $this->race_choices,
                'ethn_choices' => $this->ethn_choices,
                'prefill_data' => $data,
                'id' => $id,
             ]);
         } else {
             $data = Participant::find($id);
             $studies = Study::all();

             return view('create_or_edit')->with([
                  'page_opts' => [
                      'form_type' => 'connection',
                      'action_type' => 'edit',
                      'header_text' => 'Add a connection to '.$data->id_code,
                       'button_label' => 'Submit',
                       'title_text' => 'Add a connection to '.$data->id_code,
                  ],
                  'studies' => $studies,
                  'participant' => $data,
                  'p_id' => $id,
                  'pol_options' => [
                      'Democrat',
                      'Republican',
                      'Third-Party',
                      'Independent',
                      'Decline'
                  ],
              ]);
         }
    }

    public function updateInDB(Request $request, $id)
    {
        $edit_type = explode('/', url()->current());
        $edit_type = $edit_type[sizeof($edit_type)-2]; // derives either connection or participant

        if ($edit_type == 'participant') {
            $this->validate($request, $this->validation_rules, $this->validation_messages);

            $udpated_p = Participant::find($id);

            $fields = [
                'type',
                'gender',
                'race',
                'ethnicity',
                'age'
            ];

            foreach ($fields as $ix => $field) {
                $udpated_p[$field] = $request[$field];
            };

            $udpated_p['id_code'] = strtoupper($request['id_code']);

            $udpated_p->save();

            return redirect('/find/participant/edit')->with([
                'success_message' => 'Participant '.$udpated_p->id_code.' successfully updated!',
                'success_header' => 'Edit another participant?',
            ]);
        } else {
            $participant = Participant::find($id);
            $study = Study::find($request->study_add);
            if (!isset($request->political_affiliation)) {
                $request->political_affiliation = null;
            };
            if (!isset($request->date_run)) {
                $request->date_run = null;
            } else {
                $request->date_run = Carbon::parse($request->date_run);
            };

            $participant->studies()->save($study, [
                'political_affiliation' => $request->political_affiliation,
                'date_run' => $request->date_run,
            ]);

            return redirect('/find/participant/connect')->with([
                'success_message' => 'Participant '.$participant->id_code.' successfully connected!',
                'success_header' => 'Connect another participant?',
            ]);
        }
    }

}
