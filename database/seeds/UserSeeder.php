<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('User')->insert([
            'name' => 'Super Admin',
            'email' => 'SA@gmail.com',
            'password' => 'aaaaaaaa',
            'role' => '1'

        ])
    }
}
