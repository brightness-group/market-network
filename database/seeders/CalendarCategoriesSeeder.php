<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CalendarCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendar_categories')->insert([
            [
                'name' => 'Deadline',
            ],
            [
                'name' => 'Meeting',
            ],
            [
                'name' => 'Event',
            ]
        ]);
    }
}
