<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        $roles = array(
            'admin',
            'counsel',
            'para-legal'
        );

        $permissions = array(
            'browse',
            'read',
            'edit',
            'add',
            'delete'
        );

        $models = array(
            'user',
            'profile',
            'client',
            'counsel',
            'contract',
            'expense',
        );

        foreach ($models as $model){
            foreach ($permissions as $permission){
                Permission::create(['name' => $permission.' '.$model, 'table_name' => $model]);
            }
        }

        foreach ($roles as $role){
            $type = Role::create(['name' => $role]);
            if($role === 'admin'){
                $type->givePermissionTo(Permission::all());
            }
        }

        $userList = array(
            array('Admin', 'admin@gmail.com', 'pacific'),
            array('Counsel', 'counsel@gmail.com', 'pacific'),
            array('Para-Legal', 'paralegal@gmail.com', 'pacific'),
        );

        foreach($userList as $data){
            $user = new User();
            $user->name = $data[0];
            $user->email = $data[1];
            $user->password = bcrypt($data[2]);
            if($user->save()){
                switch ($user->name) {
                    case 'Counsel':
                        $user->assignRole('counsel');
                        break;
                    case 'Para-Legal':
                        $user->assignRole('para-legal');
                        break;
                    default:
                        $user->assignRole('admin');
                }
            }
        }

    }
}
