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
        //
        DB::table('users')->insert([
            [
                'username' => 'hagane' ,
                 'mail' => 'hagane@gmail.com',
                 'password' => 'pikachu'
            ]
        ]);
    }
}
