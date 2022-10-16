<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1, 
                'role' => 'Supar Admin', 
                'status' => 'A', 
                'deletable' => '1', 
                'permission' => null,  
                'is_deleted' => "N",
                'add_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]
        ];
        DB::table('user_role')->insert($users);
    }
}
