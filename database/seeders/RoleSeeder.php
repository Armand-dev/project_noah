<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'administrator']);
        $leader = Role::updateOrCreate(['name' => 'leader']);
        Role::updateOrCreate(['name' => 'member']);

        $permission = Permission::updateOrCreate(['name' => 'create users']);

        $leader->givePermissionTo($permission);
    }
}
