<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' =>'dashboard'],['name'=>'profile-view'],['name'=>'profile-edit'],['name'=>'user-view'],['name'=>'user-create'],['name'=>'user-edit'],['name'=>'user-delete'],['name'=>'role-view'],['name'=>'role-create'],['name'=>'role-edit'],['name'=>'role-delete'],['name'=>'rolepermission-update'],['name'=>'permission-view'],['name'=>'permission-create'],['name'=>'permission-edit'],['name'=>'permission-delete']
        ];
        foreach($permissions as $permission)
        {
            Permission::create($permission);
        }
    }
}
