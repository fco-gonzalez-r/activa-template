<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:api');
    }


    public function index(){
        $users = User::latest()->paginate(5);
        return $this->sendResponse($users, 'Users list');
    }
}
