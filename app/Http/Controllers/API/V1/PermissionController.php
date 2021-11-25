<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        $permissions = Permission::get();
        return $this->sendResponse($permissions, 'Listado de permisos');
    }
}
