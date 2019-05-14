<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StudiesTableSeeder::class);
        $this->call(ParticipantsTableSeeder::class);
        $this->call(ParticipantStudyTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
