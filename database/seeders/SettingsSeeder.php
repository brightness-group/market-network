<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'site_name' => 'SEEN',
                'tag_line' => '',
                'site_url' => '',
                'timezone' => '',
                'date_format' => '',
                'time_format' => '',
                'week_starts_on' => '',
                'currency' => 'USD',
                'currency_symbol' => '$',
            ]
        ]);
    }
}
