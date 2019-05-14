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
            'AF4628D2C5B42A' => 'nh/behavioral1',
            'AEA21EC1E98EE5' => 'nh/behavioral2',
            'AD119EEB18C8B7' => 'nh/behavioral1',
            'AB40AA84E31024' => 'nh/behavioral3',
            'AADF29CA176DB3' => 'nh/behavioral1',
            'AAC6BCE0948085' => 'nh/behavioral2',
            'A7995LF5DX6PP0' => 'nh/behavioral1',
            'A687JG7V7RY3PY' => 'nh/behavioral3',
            'A4DDEFB1B7033F' => 'nh/behavioral1',
            'A4229VMGWUK9EI' => 'nh/behavioral3',
            'A31453B576A85F' => 'nh/behavioral2',
            'A246564E1F8402' => 'nh/behavioral2',
            'A1D2OLQTNLZL91' => 'nh/behavioral2',
            'A11810C6FC6B88' => 'nh/behavioral3',
            'A05F30D7A95772' => 'nh/behavioral2',
            'AF4628D2C5B42A' => 'nh/behavioral3',
            'AEA21EC1E98EE5' => 'nh/behavioral1',
            'AD119EEB18C8B7' => 'nh/behavioral3',
            'AB40AA84E31024' => 'nh/behavioral2',
            'AADF29CA176DB3' => 'nh/behavioral2',
            'AAC6BCE0948085' => 'nh/behavioral3',
            'A7995LF5DX6PP0' => 'nh/behavioral3',
            'A687JG7V7RY3PY' => 'nh/behavioral2',
            'A4DDEFB1B7033F' => 'nh/behavioral2',
            'A4229VMGWUK9EI' => 'nh/behavioral2',
            'A31453B576A85F' => 'nh/behavioral1',
            'A246564E1F8402' => 'nh/behavioral1',
            'A1D2OLQTNLZL91' => 'nh/behavioral1',
            'A11810C6FC6B88' => 'nh/behavioral2',
            'A05F30D7A95772' => 'nh/behavioral1',
            '62629337'=> 'mc/games1',
            '45672333'=> 'mc/games1',
            '20144177'=> 'mc/games1',
            '12190301'=> 'mc/games1',
            '45672333'=> 'mc/games2',
            '20144177'=> 'mc/games2',
        ];

        foreach ($relationships as $id_code => $study_name) {

            $participant = Participant::where('id_code', 'like', $id_code)->first();

            $study = Study::where('name', 'LIKE', $study_name)->first();

            $participant->study()->save($study);
        };

    }
}
