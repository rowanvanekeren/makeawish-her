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
        DB::table('users')->delete();


        $user_row =
            array(
                'name' => 'RowanLander',
                'password' => Hash::make(123456),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            );
        DB::table('users')->insert($user_row);
    }
}
