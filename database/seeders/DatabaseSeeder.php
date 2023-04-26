<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoomSeeder::class,
        ]);

        Admin::factory()
                ->count(2)
                ->create();
        $user1 = User::factory()
                ->count(15)
                ->hasAttendances()
                ->hasKeys()
                ->hasSchedules()
                ->create();
        $user2 = User::factory()
                ->count(30)
                ->hasAttendances()
                ->hasKeys()
                ->hasSchedules()
                ->create();

        foreach ($user1 as $user) {
            UserRole::factory()->create(['user_id' => $user->id, 'role_id' => 3]);
        }

        foreach ($user2 as $user) {
            UserRole::factory()->create(['user_id' => $user->id, 'role_id' => 2]);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
