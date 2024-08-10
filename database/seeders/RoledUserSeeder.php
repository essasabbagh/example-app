<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoledUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ensure the Admin role exists
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'Teacher']);
        $studentRole = Role::firstOrCreate(['name' => 'Student']);

        User::factory()->create([
            'name' => 'Essa Sabbagh',
            'email' => 'essa@mail.com',
            'password' => Hash::make('11223344'), // Default password for demonstration
        ])->each(
                function ($user) use ($adminRole) {
                    $user->assignRole($adminRole);
                },
            );

        User::factory(10)
            ->create()
            ->each(
                function ($user) use ($adminRole) {
                    $user->assignRole($adminRole);
                },
            );

        User::factory(10)
            ->create()
            ->each(
                function ($user) use ($teacherRole) {
                    $user->assignRole($teacherRole);
                },
            );

        User::factory(25)
            ->create()
            ->each(
                function ($user) use ($studentRole) {
                    $user->assignRole($studentRole);
                },
            );
    }
}
