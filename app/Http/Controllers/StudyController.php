<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Participant;
use App\Study;


class StudyController extends Controller
{
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
}
