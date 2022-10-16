<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'email' => "quizapp@admin.com",
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('Auizapp@2022'),
            'userimage' => 'default.png',
            'user_type' => 1,
            'status' => 'A',
            'is_deleted' => 'N',
            'remember_token' => null,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
        ]);
    }
}
