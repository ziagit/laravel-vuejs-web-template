<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin  = Role::where('name', 'admin')->first();
        $user = new User();
        $user->name = 'zia';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('user12345');
        $user->save();
        $user->roles()->attach($role_user);
        $admin = new User();
        $admin->name = 'zia';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin12345');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
