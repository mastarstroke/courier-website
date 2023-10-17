<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'role_id'=> 1,
            'branch_id'=> 1,
            'name'=> 'admin user',
            'email'=> 'admin@gadmin.com',
            'username'=> 'admin',
            'password'=> bcrypt('admin'),
        ]);

        DB::table('users')->insert([
            'role_id'=> 2,
            'branch_id'=> 2,
            'name'=> 'john doe',
            'email'=> 'staff@staff.com',
            'username'=> 'staff',
            'password'=> bcrypt('staff'),
        ]);
    }
}
