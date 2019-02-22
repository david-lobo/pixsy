<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'email' => 'admin@davidlobo.co.uk',
            'name' => 'Admin',
            'password' => 'test123'
        ]);

        $role_r = Role::where('name', '=', 'Admin')->firstOrFail();
        $user->assignRole($role_r);

        $user = User::create([
            'email' => 'david@davidlobo.co.uk',
            'name' => 'David Lobo',
            'password' => 'test123'
        ]);

        $role_r = Role::where('name', '=', 'Editor')->firstOrFail();
        $user->assignRole($role_r);

        $user = User::create([
            'email' => 'steve@davidlobo.co.uk',
            'name' => 'Steve',
            'password' => 'test123'
        ]);

        $role_r = Role::where('name', '=', 'Owner')->firstOrFail();
        $user->assignRole($role_r);
    }
}
