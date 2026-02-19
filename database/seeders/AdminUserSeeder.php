<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@amaanta.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password123')]
        );

        $editor = User::firstOrCreate(
            ['email' => 'editor@amaanta.com'],
            ['name' => 'Content Editor', 'password' => Hash::make('password123')]
        );

        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $editorRole = Role::where('name', 'editor')->firstOrFail();

        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        $editor->roles()->syncWithoutDetaching([$editorRole->id]);
    }
}
