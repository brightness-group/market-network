<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professions')->insert([
            [
                'name' => 'Interior Designer',
            ],
            [
                'name' => 'Architect',
            ],
            [
                'name' => 'Event Manager',
            ],
            [
                'name' => 'Fashion Designer',
            ],
            [
                'name' => 'Yoga Trainer',
            ],
            [
                'name' => 'Zumba Instructure',
            ],
            [
                'name' => 'Health Coach',
            ],
            [
                'name' => 'Nutrition Specialties',
            ],
            [
                'name' => 'Tutor',
            ],
        ]);
    }
}
