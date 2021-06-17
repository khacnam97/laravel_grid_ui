<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        //user admin , role admin
        $user =  User::create([
            'name' => 'admin1',
            'password' => \Hash::make('admin'),
            'email' => 'nam1@gmail.com'
        ]);
        $role = Role::findByName('admin');

        $user->assignRole([$role->id]);
        //user distribution center , role distribution center
        $userDis =  User::create([
            'name' => 'distributionCenter',
            'password' => \Hash::make('123456'),
            'email' => 'kadms@gmail.com'
        ]);
        $roleDis = Role::findByName('distribution center');

        $userDis->assignRole([$roleDis->id]);
    }
}
