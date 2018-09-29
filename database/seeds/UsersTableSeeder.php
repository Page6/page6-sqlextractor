<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'     =>env('APP_ADMIN', 'admin'),
                'password' =>env('APP_ADMIN_PASSWORD', '123456')
            ],
            [
                'name'     =>'guest_a_1',
                'password' =>'$2y$10$oMYukwRvDiKem0nPxljk5usQi7eYgAA3tzESws4veNdn8XY/fIKKu'
            ],
            [
                'name'     =>'guest_b_1',
                'password' =>'$2y$10$oMYukwRvDiKem0nPxljk5usQi7eYgAA3tzESws4veNdn8XY/fIKKu'
            ]
        ]);
    }
}
