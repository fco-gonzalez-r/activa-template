<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseController
{
    public function index(Request $request){
        $roles = Role::with('permissions')->orderBy('name')->paginate(10);
        return $this->sendResponse($roles, 'Listado de Roles');
    }

    public function list(){
        $roles = Role::orderBy('name')->get(['name']);
        return $this->sendResponse($roles, 'Listado de Roles');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return $this->sendResponse($role, 'Rol creado satisfactoriamente');
    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return $this->sendResponse($role, 'Rol actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        $role = DB::table("roles")->where('id',$id)->delete();
        return $this->sendResponse([$role], 'User has been Deleted');
    }

    
}
