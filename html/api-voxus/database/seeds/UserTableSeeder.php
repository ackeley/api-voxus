<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Api User',
            'email' => 'apiuser@apiuser.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
