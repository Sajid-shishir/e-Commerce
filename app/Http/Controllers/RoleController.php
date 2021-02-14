<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleController extends Controller
{
    function managerole(){
        return view('admin.role.index',[

            'permissions' => Permission::all(),
            'roles' => Role::all(),
            'users' =>User::where('role',1)->get()
        ]);
        // $permission = Permission::create(['name' => 'add coupon']);
    }

    function roleadd(Request $request){

        $request->validate([

            'role_name' => 'unique:roles,name'
        ]);

        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back();

    }
    function roleassign(Request $request){

        // print_r($request->all());

        $user = User::find($request->user_id);
        // $user ->assignRole($request->role_name); // for multiple roles
        $user ->syncRoles($request->role_name); // for single roles
        return back();



    }
    function role_permission_edit($user_id){

        return view('admin.role.edit',[

            'permissions' => Permission::all(),
            'user' => User::find($user_id)
        ]);

    }
    function role_permission_edit_post(Request $request){

        $user =User::find($request->user_id);
        $user ->syncPermissions($request->permission);
        return redirect('manage/role');

    }




}
