<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User,
    Employee,
    Roles,
    Level,
    SchoolPeriod,
    SectionType,
    School_Info
    };

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
        School_Info::create([
            'id'=>'1',
            'school_name'=>'Magister',
            'tax_number'=>'',
            'email'=>'magister2023@hotmail.com',
            'phone_number'=>'987654321',
            'city'=>'Lima',
            'adress'=>'Av. Pacífico 431, Independencia 15311',
            'url_img'=>''
        ]);

        $levelsData = [
            ['description' => 'INICIAL'],
            ['description' => 'PRIMARIA'],
            ['description' => 'SECUNDARIA']
        ];
        
        foreach($levelsData as $level)
        {
            Level::create($level);
        }

        $periods_data = [
            ['period_name' => '2023-I', 'start_date' => '2023-07-10', 'end_date' => '2023-12-10', 'status' => 1],
            ['period_name' => '2023-II', 'start_date' => '2024-01-10', 'end_date' => '2024-03-30', 'status' => 1],
        ];

        foreach($periods_data as $period)
        {
            SchoolPeriod::create($period);
        }

        $sectionTypes_data = [
            ['section_type' => '1ER GRADO'],
            ['section_type' => '2DO GRADO'],
            ['section_type' => '3ER GRADO'],
            ['section_type' => '4TO GRADO'],
            ['section_type' => '5TO GRADO'],
            ['section_type' => '6TO GRADO']
        ];

        foreach($sectionTypes_data as $sectionType)
        {
            SectionType::create($sectionType);
        }


        User::create([
            'id_employee'=>'1',
            'username' => 'admin',
            'password'=>Hash::make('magister23')
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
