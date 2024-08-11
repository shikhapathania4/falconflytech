<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage vendors']);
        Permission::create(['name' => 'add services']);
        Permission::create(['name' => 'edit services']);
        Permission::create(['name' => 'delete services']);
        Permission::create(['name' => 'publish services']);
        Permission::create(['name' => 'unpublish services']);
        Permission::create(['name' => 'add promotion']);
        Permission::create(['name' => 'edit promotion']);
        Permission::create(['name' => 'delete promotion']);
        Permission::create(['name' => 'publish promotion']);
        Permission::create(['name' => 'unpublish promotion']);

        $role = Role::create(['name' => 'vendor']);
        $role->givePermissionTo('edit services');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
