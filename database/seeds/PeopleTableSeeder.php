<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
        	[
                'name'     =>'people1',
                'age'      =>'1',
                'sex'      =>'male',
                'birthday' =>'2018-09-01'
        	],
        	[
                'name'     =>'people2',
                'age'      =>'2',
                'sex'      =>'female',
                'birthday' =>'2018-09-02'
        	],
        	[
                'name'     =>'people3',
                'age'      =>'3',
                'sex'      =>'female',
                'birthday' =>'2018-09-03'
        	],
        	[
                'name'     =>'people4',
                'age'      =>'4',
                'sex'      =>'male',
                'birthday' =>'2018-09-04'
        	],
        	[
                'name'     =>'people5',
                'age'      =>'5',
                'sex'      =>'male',
                'birthday' =>'2018-09-05'
        	]
        ]);
    }
}
