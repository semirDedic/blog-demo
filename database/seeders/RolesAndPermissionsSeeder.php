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

        // create permissions
        Permission::create(['name' => 'view unpublished posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit own posts']);
        Permission::create(['name' => 'edit all posts']);
        Permission::create(['name' => 'delete own posts']);
        Permission::create(['name' => 'delete any post']);
        Permission::create(['name' => 'force delete post']);
        Permission::create(['name' => 'restore own post']);
        Permission::create(['name' => 'restore any post']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'unpublish posts']);        

        // create roles and assign created permissions
        $role = Role::create(['name' => 'member']);

        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo(['create posts', 'edit own posts', 'delete own posts', 'restore own post']);

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['view unpublished posts', 'edit all posts', 'publish posts', 'unpublish posts']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
