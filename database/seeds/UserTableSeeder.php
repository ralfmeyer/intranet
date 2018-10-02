<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_editor = Role::where('name', 'editor')->first();
        $role_author = Role::where('name', 'author')->first();
        $role_user = Role::where('name', 'user')->first();
 
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('pass');
        $admin->save();
        $admin->roles()->attach($role_admin);
 
        $editor = new User();
        $editor->name = 'editor';
        $editor->email = 'editor@example.com';
        $editor->password = bcrypt('pass');
        $editor->save();
        $editor->roles()->attach($role_editor);
 
        $author = new User();
        $author->name = 'author';
        $author->email = 'author@example.com';
        $author->password = bcrypt('pass');
        $author->save();
        $author->roles()->attach($role_author);
 
 
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@example.com';
        $user->password = bcrypt('pass');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
