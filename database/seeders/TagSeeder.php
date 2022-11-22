<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'Interior',
            ],
            [
                'name' => 'Fashion',
            ],
            [
                'name' => 'Party',
            ],
            [
                'name' => 'Food',
            ],
            [
                'name' => 'Decoration',
            ],
        ]);
    }
}
