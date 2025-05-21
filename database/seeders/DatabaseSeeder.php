<?php

namespace Database\Seeders;

use App\Models\RoleTeamUser;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            TeamSeeder::class,
        ]);

        $adminUser = User::where('email', 'admin@crmer.com')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $adminTeam = Team::where('name', 'Admin Team')->first();

        $adminUser->assignRole('admin');

        RoleTeamUser::create([
            'user_id' => $adminUser->id,
            'role_id' => $adminRole->id,
            'team_id' => $adminTeam->id,
        ]);

        $workerUser = User::where('email', 'worker@crmer.com')->first();
        $workerRole = Role::where('name', 'worker')->first();

        RoleTeamUser::create([
            'user_id' => $workerUser->id,
            'role_id' => $workerRole->id,
        ]);

    }
}
