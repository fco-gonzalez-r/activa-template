<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'Super-Admin']);
        $superAdmin = User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt("password")
        ]);
        $superAdmin->assignRole($superAdminRole);

        $managerRole = Role::create(['name' => 'Manager']);
        $manager = User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@mail.com',
            'password' => bcrypt("password")
        ]);
        $manager->assignRole($managerRole);

        $employeeRole = Role::create(['name' => 'Employe']);
        $employee = User::factory()->create([
            'name' => 'employee',
            'email' => 'employee@mail.com',
            'password' => bcrypt("password")
        ]);
        $employee->assignRole($employeeRole);

        Permission::create(['name' => 'list programs']);
        Permission::create(['name' => 'create programs']);
        Permission::create(['name' => 'show programs']);
        Permission::create(['name' => 'update programs']);
        Permission::create(['name' => 'delete programs']);

        Permission::create(['name' => 'show own programs']);
        Permission::create(['name' => 'update own programs']);
        Permission::create(['name' => 'delete own programs']);
        Permission::create(['name' => 'restore own programs']);


        $manager->givePermissionTo([
            'list programs', 'create programs', 'show programs', 'update programs', 'delete own programs'
        ]);

        $employee->givePermissionTo([
            'list programs', 'create programs', 'show own programs', 'update own programs',
            'delete own programs', 'restore own programs'
        ]);


        
    }
}
