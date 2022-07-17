<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(BloodTableSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(religionTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(ParentsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);


    }
}
