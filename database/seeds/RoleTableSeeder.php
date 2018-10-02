<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Administrator';
        $role_admin->save();
 
        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'Benutzer';
        $role_user->save();
 
        $role_author = new Role();
        $role_author->name = 'author';
        $role_author->description = 'Autor';
        $role_author->save();
 
        $role_editor = new Role();
        $role_editor->name = 'editor';
        $role_editor->description = 'Bearbeiter';
        $role_editor->save();
    }
}
