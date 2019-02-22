<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        \Artisan::call('db:seed', ['--class' => 'UsersTableSeeder']);
    }

    public function test_have_3_users()
    {
        $this->assertEquals(3, User::count());
    }

    public function test_have_user1()
    {
        $user = User::where('email', 'admin@davidlobo.co.uk')->first();
        $this->assertFalse(is_null($user));
        $this->assertEquals($user->email, 'admin@davidlobo.co.uk');
        $this->assertEquals($user->name, 'Admin');
    }

    public function test_have_user2()
    {
        $user = User::where('email', 'david@davidlobo.co.uk')->first();
        $this->assertFalse(is_null($user));
        $this->assertEquals($user->email, 'david@davidlobo.co.uk');
        $this->assertEquals($user->name, 'David Lobo');
    }

    public function test_have_user3()
    {
        $user = User::where('email', 'steve@davidlobo.co.uk')->first();
        $this->assertFalse(is_null($user));
        $this->assertEquals($user->email, 'steve@davidlobo.co.uk');
        $this->assertEquals($user->name, 'Steve');
    }

    public function tearDown()
    {
        \Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
