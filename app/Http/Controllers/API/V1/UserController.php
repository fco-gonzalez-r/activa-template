<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\UserRequest;

class UserController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:api');
    }


    public function index(){
        $name = \request()->get('name') !== null ? \request()->get('name') : '';

        $users = User::orderBy('name')
            ->where('name', 'like', '%'. $name .'%')    
            ->paginate(5);
        return $this->sendResponse($users, 'Users list');
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole($request->input('role'));

        return $this->sendResponse($user, 'User creado satisfactoriamente');
    }

    public function update(UserRequest $request, User $user)
    {

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        else {
            request()->request->remove('password');
        }

        $user->update($request->all());
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('role'));
        // $user->assignRole();

        return $this->sendResponse($user, 'User Information has been updated');
    }

    public function destroy(User $user)
    {
        // $this->authorize('isAdmin');
        // $user = User::findOrFail($id);
        $user->delete();
        return $this->sendResponse([$user], 'User has been Deleted');
    }
}
