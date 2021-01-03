<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            //Article
            ['name'=>'list article', 'guard_name' => 'web'],
            ['name' => 'create article', 'guard_name' => 'web'],
            ['name' => 'edit article', 'guard_name' => 'web'],
            ['name' => 'view article', 'guard_name' => 'web'],
            ['name' => 'delete article', 'guard_name' => 'web'],
            //User
            ['name' => 'list user', 'guard_name' => 'web'],
            ['name' => 'create user', 'guard_name' => 'web'],
            ['name' => 'edit user', 'guard_name' => 'web'],
            ['name' => 'view user', 'guard_name' => 'web'],
            ['name' => 'delete user', 'guard_name' => 'web'],
            //Role
            ['name' => 'list role', 'guard_name' => 'web'],
            ['name' => 'create role', 'guard_name' => 'web'],
            ['name' => 'edit role', 'guard_name' => 'web'],
            ['name' => 'view role', 'guard_name' => 'web'],
            ['name' => 'delete role', 'guard_name' => 'web'],
            //Page
            ['name' => 'list page', 'guard_name' => 'web'],
            ['name' => 'create page', 'guard_name' => 'web'],
            ['name' => 'edit page', 'guard_name' => 'web'],
            ['name' => 'view page', 'guard_name' => 'web'],
            ['name' => 'delete page', 'guard_name' => 'web']

        ]);
    }
}
