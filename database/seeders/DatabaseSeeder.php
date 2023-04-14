<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(numberCodeSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(NoticeSeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(NumberOwnerSeeder::class);
        $this->call(CitizenshipSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CharacteristicSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(MaritalStatusSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(WorkScheduleSeeder::class);
        $this->call(AllergySeeder::class);
        $this->call(WorkExperienceSeeder::class);
        $this->call(NoReasonSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(CurenceSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
