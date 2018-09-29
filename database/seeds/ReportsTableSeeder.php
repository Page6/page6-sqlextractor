<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
            [
				'report_name' =>'people_name',
				'report_type' =>'1',
				'report_sql'  =>'SELECT * FROM people WHERE name = ?'
            ],
            [
				'report_name' =>'people_age',
				'report_type' =>'1',
				'report_sql'  =>'SELECT * FROM people WHERE age = ?'
            ],
            [
				'report_name' =>'people_sex',
				'report_type' =>'2',
				'report_sql'  =>'SELECT * FROM people WHERE sex = ?'
            ],
            [
                'report_name' =>'people_birthday',
                'report_type' =>'3',
                'report_sql'  =>'SELECT * FROM people WHERE birthday >= ? AND birthday < ?'
            ]
        ]);
    }
}
