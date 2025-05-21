<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAdmin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@crmer.com',
            'password' => 'password',
        ]);


        $userWorker = User::firstOrCreate([
            'name' => 'Worker',
            'email' => 'worker@crmer.com',
            'password' => 'password',
        ]);
    }
}
