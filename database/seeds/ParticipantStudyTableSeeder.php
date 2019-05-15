<?php

use Illuminate\Database\Seeder;
use App\Study;
use App\Participant;

class ParticipantStudyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relationships = [
            'AF4628D2C5B42A' => ['nh/behavioral1', 'Democrat'],
            'AEA21EC1E98EE5' => ['nh/behavioral2', 'Republican'],
            'AD119EEB18C8B7' => ['nh/behavioral1', 'Republican'],
            'AB40AA84E31024' => ['nh/behavioral3', 'Democrat'],
            'AADF29CA176DB3' => ['nh/behavioral1', 'Third-Party'],
            'AAC6BCE0948085' => ['nh/behavioral2', 'Republican'],
            'A7995LF5DX6PP0' => ['nh/behavioral1', 'Democrat'],
            'A687JG7V7RY3PY' => ['nh/behavioral3', 'Third-Party'],
            'A4DDEFB1B7033F' => ['nh/behavioral1', 'Democrat'],
            'A4229VMGWUK9EI' => ['nh/behavioral3', 'Independent'],
            'A31453B576A85F' => ['nh/behavioral2', 'Republican'],
            'A246564E1F8402' => ['nh/behavioral2', 'Democrat'],
            'A1D2OLQTNLZL91' => ['nh/behavioral2', 'Democrat'],
            'A11810C6FC6B88' => ['nh/behavioral3', 'Republican'],
            'A05F30D7A95772' => ['nh/behavioral2', 'Republican'],
            'AF4628D2C5B42A' => ['nh/behavioral3', 'Third-Party'],
            'AEA21EC1E98EE5' => ['nh/behavioral1', 'Democrat'],
            'AD119EEB18C8B7' => ['nh/behavioral3', 'Republican'],
            'AB40AA84E31024' => ['nh/behavioral2', 'Democrat'],
            'AADF29CA176DB3' => ['nh/behavioral2', 'Republican'],
            'AAC6BCE0948085' => ['nh/behavioral3', 'Republican'],
            'A7995LF5DX6PP0' => ['nh/behavioral3', 'Independent'],
            'A687JG7V7RY3PY' => ['nh/behavioral2', 'Democrat'],
            'A4DDEFB1B7033F' => ['nh/behavioral2', 'Third-Party'],
            'A4229VMGWUK9EI' => ['nh/behavioral2', 'Republican'],
            'A31453B576A85F' => ['nh/behavioral1', 'Republican'],
            'A246564E1F8402' => ['nh/behavioral1', 'Democrat'],
            'A1D2OLQTNLZL91' => ['nh/behavioral1', 'Independent'],
            'A11810C6FC6B88' => ['nh/behavioral2', 'Democrat'],
            'A05F30D7A95772' => ['nh/behavioral1', 'Democrat'],
            '62629337'=> ['mc/games1', 'Democrat'],
            '45672333'=> ['mc/games1', 'Republican'],
            '20144177'=> ['mc/games1', 'Democrat'],
            '12190301'=> ['mc/games1', 'Republican'],
            '45672333'=> ['mc/games2', 'Democrat'],
            '20144177'=> ['mc/games2', 'Democrat'],
        ];

        $count = count($relationships);

        foreach ($relationships as $id_code => $study_array) {

            $participant = Participant::where('id_code', 'like', $id_code)->first();

            $study = Study::where('name', 'LIKE', $study_array[0])->first();

            $participant->studies()->save($study, [
                'political_affiliation' => $study_array[1],
                'date_run' => Carbon\Carbon::now()->subDays($count+12)->toDateString(),
            ]);

            $count--;
        };

    }
}
