<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policies')->insert([
            'code' => 'HN-HEAD-BP',
            'name' => 'base-pay',
            'description' => 'Base-pay of Salary, depend on region, location office. Base-pay is the lowest money which pay for a staff',
            'type' => '1', // 1 is contantly; 2 is reference to another policy
            'valid_from' => Carbon::parse('06-01-2024 00:00:00'),
            'valid_to' => Carbon::parse('06-05-2024 00:00:00'),
            'value' => 6000000,
            'unit_value' => 'VND',
            'color' => 'green',
        ]);
    }
}
