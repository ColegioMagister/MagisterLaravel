<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Employee, Roles};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['id'=>'1','role_name'=>'Admin'],
            ['id'=>'2','role_name'=>'Profesor']
        ];
        foreach ($data as $roles) {
            Roles::create($roles);
        }

        
        Employee::create([
            'id'=>'1',
            'id_role'=>'1',
            'name'=>'Daniel',
            'lastname'=>'Alvarez',
            'email'=>'daniel@hotmail.com',
            'phone_number'=>'992504498',
            'url_img'=>''
        ]);
        User::create([
            'id_employee'=>'1',
            'username' => 'admin',
            'password'=>Hash::make('magister23')
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
