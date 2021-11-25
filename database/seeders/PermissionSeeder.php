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
            'name' => 'Francisco González',
            'email' => 'francisco@epulso.cl',
            'password' => bcrypt("password")
        ]);
        $superAdmin->assignRole($superAdminRole);

        // $managerRole = Role::create(['name' => 'Manager']);
        // $manager = User::factory()->create([
        //     'name' => 'manager',
        //     'email' => 'manager@mail.com',
        //     'password' => bcrypt("password")
        // ]);
        // $manager->assignRole($managerRole);

        // $employeeRole = Role::create(['name' => 'Employe']);
        // $employee = User::factory()->create([
        //     'name' => 'employee',
        //     'email' => 'employee@mail.com',
        //     'password' => bcrypt("password")
        // ]);
        // $employee->assignRole($employeeRole);


        $permiso1 = Permission::create(['name' => 'rol-listar']);
        $permiso2 = Permission::create(['name' => 'rol-crear']);
        $permiso3 = Permission::create(['name' => 'rol-editar']);
        $permiso4 = Permission::create(['name' => 'rol-eliminar']);

        $permiso5 = Permission::create(['name' => 'permiso-listar']);
        $permiso6 = Permission::create(['name' => 'permiso-crear']);
        $permiso7 = Permission::create(['name' => 'permiso-editar']);
        $permiso8 = Permission::create(['name' => 'permiso-eliminar']);

        $permiso9 = Permission::create(['name' => 'usuario-listar']);
        $permiso10 = Permission::create(['name' => 'usuario-crear']);
        $permiso11 = Permission::create(['name' => 'usuario-editar']);
        $permiso12 = Permission::create(['name' => 'usuario-eliminar']);

        $superAdminRole->syncPermissions($permiso1, $permiso2, $permiso3, $permiso4, $permiso5, $permiso6, $permiso7, $permiso8, $permiso9, $permiso10, $permiso11, $permiso12);



        // $superAdminRole->givePermissionTo([
        //     'list programs', 'create programs', 'show programs', 'update programs', 'delete own programs'
        // ]);

        // $employee->givePermissionTo([
        //     'list programs', 'create programs', 'show own programs', 'update own programs',
        //     'delete own programs', 'restore own programs'
        // ]);


        
    }
}
