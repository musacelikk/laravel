<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        User::query()->each(function (User $user) use ($adminRole, $userRole): void {
            if ($user->type === 'admin' || $user->email === 'test@example.com') {
                $user->roles()->syncWithoutDetaching([$adminRole->id]);

                return;
            }

            $user->roles()->syncWithoutDetaching([$userRole->id]);
        });
    }
}
