<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create([
            'name' => 'Admin',
        ]);
        $role2 = Role::create([
            'name' => 'Player',
        ]);
        
        Permission::create(['name' => 'user.getPlayers'])->assignRole($role1);
        Permission::create(['name' => 'user.getRanking'])->assignRole($role1);
        Permission::create(['name' => 'user.getWorstPlayer'])->assignRole($role1);
        Permission::create(['name' => 'user.getBestPlayer'])->assignRole($role1);
        
        Permission::create(['name' => 'register'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'login'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user.updateName'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user.getUserGames'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user.createGame'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user.deleteGames'])->syncRoles([$role1, $role2]);
        
    } 
}
