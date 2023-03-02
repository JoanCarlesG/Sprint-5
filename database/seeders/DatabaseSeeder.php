<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' =>  bcrypt(123456),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' =>  bcrypt(123456),
        ]);

        \App\Models\Game::create([
            'player_id' => 1,
            'throw1' => rand(1, 6),
            'throw2' => rand(1, 6),
            'win' => rand(1,2),
        ]);

        \App\Models\Game::create([
            'player_id' => 2,
            'throw1' => rand(1, 6),
            'throw2' => rand(1, 6),
            'win' => rand(1,2),
        ]);

        \App\Models\Role::create([
            'role' => 'Admin',
            'user_id' => 1,
        ]);

        \App\Models\Role::create([
            'role' => 'Player',
            'user_id' => 2,
        ]);
        
        
        // Permission::create(['name' => 'user.getPlayers'])->assignRole($role1);

        // Permission::create(['name' => 'user.getRanking'])->assignRole($role1);
        // Permission::create(['name' => 'user.getWorstPlayer'])->assignRole($role1);
        // Permission::create(['name' => 'user.getBestPlayer'])->assignRole($role1);
        
        // Permission::create(['name' => 'register'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'login'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'user.updateName'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'user.getUserGames'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'user.createGame'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'user.deleteGames'])->syncRoles([$role1, $role2]);
    }
}
