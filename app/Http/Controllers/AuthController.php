<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseApiController;

class AuthController extends BaseApiController
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'permission' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status_code' => 400, 'message'=>'Bad Request']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->assignRole($request->role);
        $user->givePermissionTo($request->permission);
        $user->save();

        return response()->json([
            'status_code'=>200,
            'message' => 'User Created Successfully'
        ]);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 400, 'message' => 'Bad Request']);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Unauthorized'
            ]);
        }

        $user = User::where('email', $request->email)->first();



        $tokenResult = $user->createToken('authToken')->plainTextToken;

        $role = $user->roles->pluck('name');

        $permission = $user->permissions->pluck('name');


        return response()->json([
            'status_code' => 200,
            'token' => $tokenResult,
            'role_as' => $role,
            'permission_as' => $permission,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Token deleted successfully!'
        ]);
    }
}
