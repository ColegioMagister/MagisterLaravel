<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id_employee'=>'1',
            'name'=>'Magister',
            'email'=>'magister23@hotmail.com',
            'password'=>Hash::make('magister23')
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
