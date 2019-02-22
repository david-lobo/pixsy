<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;

class PostTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        \Artisan::call('db:seed', ['--class' => 'UsersTableSeeder']);
        \Artisan::call('db:seed', ['--class' => 'PostsTableSeeder']);
    }

    public function test_have_24_posts()
    {
        $this->assertEquals(24, Post::count());
    }

    public function test_post_assigned_user()
    {
        $post = Post::first();
        $this->assertEquals($post->user->email, 'david@davidlobo.co.uk');
    }

    public function tearDown()
    {
        \Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
