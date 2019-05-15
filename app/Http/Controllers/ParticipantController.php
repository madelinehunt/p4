<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Study;

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

        return redirect('/create/participant')->with([
            'new_participant' => $new_participant,
        ]);
    }

    public function search(Request $request)
    {
        $results = Participant::with('studies')->where('id_code', 'like', '%'.$request->keyword.'%')->get();

        return view('search.results')->with([
            'req' => $request,
            'results' => $results,
        ]);
    }

    public function findToEdit($id = null)
    {
        if ($id == null) {
            return view('search.participant');
        } else {
            $participant = Participant::find($id);

            return view('edit.participant')->with([
                'existing_participant' => $participant,
                'participant_id' => $id,
                'gender_choices' => $this->gender_choices,
                'race_choices' => $this->race_choices,
                'ethn_choices' => $this->ethn_choices,
            ]);
        };
    }

    public function updateInDB(Request $request, $id)
    {
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

        return redirect('/find/participant')->with([
            'edited_name' => $udpated_p->id_code,
        ]);

    }

}
