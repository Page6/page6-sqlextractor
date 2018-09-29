<?php

use Illuminate\Database\Seeder;

class ReportAuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_auth')->insert([
            [
				'user_name'   =>'guest_a_1',
				'report_id' =>'1'
            ],
            [
                'user_name'   =>'guest_a_1',
                'report_id' =>'4'
            ],
            [
				'user_name'   =>'guest_b_1',
				'report_id' =>'2'
            ],
            [
				'user_name'   =>'guest_b_1',
				'report_id' =>'3'
            ]
        ]);
    }
}
