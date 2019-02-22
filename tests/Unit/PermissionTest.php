<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
    }

    public function test_have_4_permissions()
    {
        $this->assertEquals(4, Permission::count());
    }

    public function test_have_admin_permission()
    {
        $permission = Permission::where('name', 'Administer roles & permissions')->first();
        $this->assertFalse(is_null($permission));
        $this->assertEquals($permission->name, 'Administer roles & permissions');
    }

    public function test_have_create_permission()
    {
        $permission = Permission::where('name', 'Create Post')->first();
        $this->assertFalse(is_null($permission));
        $this->assertEquals($permission->name, 'Create Post');
    }

    public function test_have_edit_permission()
    {
        $permission = Permission::where('name', 'Edit Post')->first();
        $this->assertFalse(is_null($permission));
        $this->assertEquals($permission->name, 'Edit Post');
    }

    public function test_have_delete_permission()
    {
        $permission = Permission::where('name', 'Delete Post')->first();
        $this->assertFalse(is_null($permission));
        $this->assertEquals($permission->name, 'Delete Post');
    }

    public function test_have_3_roles()
    {
        $this->assertEquals(3, Role::count());
    }

    public function test_have_admin_role()
    {
        $role = Role::where('name', 'Admin')->first();
        $this->assertFalse(is_null($role));
        $this->assertEquals($role->name, 'Admin');
    }

    public function test_have_owner_role()
    {
        $role = Role::where('name', 'Owner')->first();
        $this->assertFalse(is_null($role));
        $this->assertEquals($role->name, 'Owner');
    }

    public function test_have_editor_role()
    {
        $role = Role::where('name', 'Editor')->first();
        $this->assertFalse(is_null($role));
        $this->assertEquals($role->name, 'Editor');
    }

    public function tearDown()
    {
        \Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
