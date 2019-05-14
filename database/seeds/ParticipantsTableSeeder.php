<?php

use Illuminate\Database\Seeder;
use App\Participant;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $participants = [
            # turkers
            ['A7995LF5DX6PP0', 'mturk', 'Male', 'Asian', 'Not Hispanic', 27],
            ['A4229VMGWUK9EI', 'mturk', 'Female', 'Black or African-American', 'Not Hispanic', 43],
            ['A687JG7V7RY3PY', 'mturk', 'Female', 'Multi-ethnic', 'Not Hispanic', 31],
            ['A1D2OLQTNLZL91', 'mturk', 'Non-binary', 'Decline', 'Decline', 21],
            ['AADF29CA176DB3',
                 'mturk',
                 'Decline',
                 'American Indian or Alaska Native',
                 'Decline',
            32],
            ['A31453B576A85F',
                'mturk',
                'Female',
                'American Indian or Alaska Native',
                'Hispanic',
            19],
            ['A246564E1F8402',
                'mturk',
                'Female',
                'Native Hawaiian or Other Pacific Islander',
                'Hispanic',
            21],
            ['AF4628D2C5B42A',
                'mturk',
                'Male',
                'Multi-ethnic',
                'Decline',
            28],
            ['A4DDEFB1B7033F',
                'mturk',
                'Non-binary',
                'Black or African-American',
                'Hispanic',
            22],
            ['AB40AA84E31024',
                'mturk',
                'Female',
                'Multi-ethnic',
                'Hispanic',
            35],
            ['A11810C6FC6B88',
                'mturk',
                'Non-binary',
                'Decline',
                'Hispanic',
            37],
            ['AD119EEB18C8B7',
                'mturk',
                'Non-binary',
                'American Indian or Alaska Native',
                'Hispanic',
            24],
            ['A05F30D7A95772',
                'mturk',
                'Male',
                'Multi-ethnic',
                'Decline',
            23],
            ['AAC6BCE0948085', 'mturk', 'Female', 'Other', 'Hispanic', 30],
            ['AEA21EC1E98EE5',
                'mturk',
                'Female',
                'Black or African-American',
                'Decline',
            33],

            #fMRI participants
            ['45672333', 'fMRI', 'Male', 'White', 'Not Hispanic', 22],
            ['62629337', 'fMRI', 'Female', 'White', 'Hispanic', 21],
            ['12190301', 'fMRI', 'Female', 'Multi-ethnic', 'Hispanic', 19],
            ['20144177', 'fMRI', 'Decline', 'Asian', 'Not Hispanic', 20],
        ];

        $count = count($participants);

        foreach ($participants as $initialParticipant) {
            $participants = new Participant();

            $participants->created_at = Carbon\Carbon::now()->subDays($count+1)->toDateTimeString();
            $participants->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $participants->id_code = $initialParticipant[0];
            $participants->participant_type = $initialParticipant[1];
            $participants->gender = $initialParticipant[2];
            $participants->race = $initialParticipant[3];
            $participants->ethnicity = $initialParticipant[4];
            $participants->age = $initialParticipant[5];

            $participants->save();

            $count--;
        }

    }
}
