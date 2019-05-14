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
    }

    public function create()
    {
        
    }
}
