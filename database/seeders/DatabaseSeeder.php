<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Attendance;
use App\Models\Key;
use App\Models\Role;
use App\Models\Room;
use App\Models\Schedule;
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
        $rooms = Room::factory()
                ->count(10)
                ->create();
        Admin::factory()
                ->count(2)
                ->create();
        $user1 = User::factory()
                ->count(15)
                ->create();
        $user2 = User::factory()
                ->count(30)
                ->create();

        foreach ($user1 as $user) {
            UserRole::factory()->create(['user_id' => $user->id, 'role_id' => 3]);
        }

        foreach ($user2 as $user) {
            UserRole::factory()->create(['user_id' => $user->id, 'role_id' => 2]);
        }

        $roomsCollection = collect($rooms);
        $faculties = UserRole::where('role_id', 2)->inRandomOrder()->get();
        foreach ($faculties as $faculty) {
            $randomRoom = $roomsCollection->random();

            Key::factory()
                ->create([
                    'user_id' => $faculty->user_id, 
                    'room_id' => $randomRoom ,
                ]);

            Schedule::factory()
                ->create([
                    'user_id' => $faculty->user_id, 
                    'room_id' => $randomRoom ,
                ]);
        }
    }
}
