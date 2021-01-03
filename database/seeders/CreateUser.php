<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'prateek';
        $user->email = 'prateek@gmail.com';
        $user->password = bcrypt('123456');
        $user->save();

        $user1 = new User();
        $user1->name = 'tyson';
        $user1->email = 'tyson@gmail.com';
        $user1->password = bcrypt('123456');
        $user1->save();

        $user2 = new User();
        $user2->name = 'raghav';
        $user2->email = 'raghav@gmail.com';
        $user2->password = bcrypt('123456');
        $user2->save();

        $user3 = new User();
        $user3->name = 'rahul';
        $user3->email = 'rahul@gmail.com';
        $user3->password = bcrypt('123456');
        $user3->save();

        $user4 = new User();
        $user4->name = 'vikram';
        $user4->email = 'vikram@gmail.com';
        $user4->password = bcrypt('123456');
        $user4->save();


        if ($user) {
            $role = Role::create(['name' => 'admin']);
            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        }

        //dont able to find another method //

        $permissions1 = Permission::where(['id' => '1'])->pluck('id');
        $permissions2 = Permission::where(['id' => '2'])->pluck('id');
        $permissions3 = Permission::where(['id' => '3'])->pluck('id');
        $permissions4 = Permission::where(['id' => '4'])->pluck('id');
        $permissions5 = Permission::where(['id' => '5'])->pluck('id');
        $permissions6 = Permission::where(['id' => '6'])->pluck('id');
        $permissions7 = Permission::where(['id' => '7'])->pluck('id');
        $permissions8 = Permission::where(['id' => '8'])->pluck('id');
        $permissions9 = Permission::where(['id' => '9'])->pluck('id');
        $permissions10 = Permission::where(['id' => '10'])->pluck('id');
        $permissions11 = Permission::where(['id' => '11'])->pluck('id');
        $permissions12= Permission::where(['id' => '12'])->pluck('id');
        $permissions13 = Permission::where(['id' => '13'])->pluck('id');
        $permissions14 = Permission::where(['id' => '14'])->pluck('id');
        $permissions15 = Permission::where(['id' => '15'])->pluck('id');
        $permissions16 = Permission::where(['id' => '16'])->pluck('id');
        $permissions17 = Permission::where(['id' => '17'])->pluck('id');
        $permissions18 = Permission::where(['id' => '18'])->pluck('id');
        $permissions19 = Permission::where(['id' => '19'])->pluck('id');
        $permissions20 = Permission::where(['id' => '20'])->pluck('id');


        if ($user1) {
            $role = Role::create(['name' => 'writer']);
            $role->syncPermissions($permissions1, $permissions2, $permissions3, $permissions4, $permissions5, $permissions6, $permissions7, $permissions8, $permissions9, $permissions10);
            $user1->assignRole([$role->id]);
        }

        if($user2){
            $role = Role::create(['name'=>'author']);
            $role->syncPermissions($permissions1, $permissions2, $permissions3, $permissions4, $permissions5);
            $user2->assignRole('author');
        }

        if($user3){
            $role = Role::create(['name'=>'manager']);
            $role->syncPermissions($permissions1, $permissions2, $permissions3, $permissions4, $permissions5, $permissions11,$permissions12, $permissions13, $permissions14, $permissions15);
            $user3->assignRole('manager');

        }

        if($user4){
            $role = Role::create(['name'=>'employee']);
            $role->syncPermissions($permissions1, $permissions16);
            $user4->assignRole($role);

        }
    }
}
