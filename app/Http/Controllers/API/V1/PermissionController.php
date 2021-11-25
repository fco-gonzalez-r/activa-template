<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        $name = \request()->get('name') !== null ? \request()->get('name') : '';

        $permissions = Permission::where('name', 'like', '%'. $name .'%')
            ->orderBy('name')->paginate(10);
        return $this->sendResponse($permissions, 'Listado de permisos');
    }

    public function list()
    {
        $permissions = Permission::orderBy('name')->get(['name', 'id']);
        return $this->sendResponse($permissions, 'Listado de permisos');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);
    
        $permission = Permission::create(['name' => $request->input('name')]);
    
        return $this->sendResponse($permission, 'Rol creado satisfactoriamente');
    }

    public function show($id)
    {
        dd("asasasa");
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();
    
        $permission->syncPermissions($request->input('permission'));
    
        return $this->sendResponse($permission, 'Permiso actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        $permission = DB::table("permissions")->where('id',$id)->delete();
        return $this->sendResponse([$permission], 'User has been Deleted');
    }


}
