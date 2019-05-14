<?php

use Illuminate\Database\Seeder;
use App\Study;

class StudiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studies = [
            ['nh/behavioral1', 'mturk', 46, 43, 'National Science Foundation'],
            ['nh/behavioral2', 'mturk', 341, 302, 'Harvard-Funded'],
            ['nh/behavioral3', 'mturk', 701, 690, 'National Science Foundation'],
            ['mc/games1', 'fMRI', 22, 22, 'National Science Foundation'],
            ['mc/games2', 'fMRI', 14, 14, 'Harvard-Funded'],
        ];

        $count = count($studies);

        foreach ($studies as $initialStudy) {
            $study = new Study();

            $study->created_at = Carbon\Carbon::now()->subDays($count+1)->toDateTimeString();
            $study->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $study->name = $initialStudy[0];
            $study->type = $initialStudy[1];
            $study->accepted = $initialStudy[2];
            $study->submitted = $initialStudy[3];
            $study->fund = $initialStudy[4];

            $study->save();

            $count--;
        }

    }
}
