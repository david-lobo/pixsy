<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('permissions')->delete();
        DB::table('roles')->delete();

        $permissionAdmin = new Permission();
        $permissionAdmin->name = 'Administer roles & permissions';
        $permissionAdmin->save();

        $permissionCreate = new Permission();
        $permissionCreate->name = 'Create Post';
        $permissionCreate->save();

        $permissionEdit = new Permission();
        $permissionEdit->name = 'Edit Post';
        $permissionEdit->save();

        $permissionDelete= new Permission();
        $permissionDelete->name = 'Delete Post';
        $permissionDelete->save();

        $roleAdmin = new Role();
        $roleAdmin->name = 'Admin';
        $roleAdmin->save();

        $roleEditor = new Role();
        $roleEditor->name = 'Editor';
        $roleEditor->save();

        $roleOwner = new Role();
        $roleOwner->name = 'Owner';
        $roleOwner->save();

        $roleAdmin->givePermissionTo($permissionAdmin);
        $roleAdmin->givePermissionTo($permissionCreate);
        $roleAdmin->givePermissionTo($permissionEdit);
        $roleAdmin->givePermissionTo($permissionDelete);

        $roleEditor->givePermissionTo($permissionEdit);
        $roleEditor->givePermissionTo($permissionCreate);

        $roleOwner->givePermissionTo($permissionDelete);
        $roleOwner->givePermissionTo($permissionEdit);
        $roleOwner->givePermissionTo($permissionCreate);
    }
}
