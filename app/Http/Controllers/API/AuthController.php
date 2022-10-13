<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email|max:191|unique:users,email',
            'password'=>'required|min:8',

        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'validation_errors'=> $validator->messages(),
            ]);
        } else {
            $admin = Admin::create([
                'password'=> Hash::make($request->password),
                'email'=> $request->email,
            ]);

            $token = $admin->createToken($admin->email.'_Token')->plainTextToken;
            
            return response()->json([
                'status'=>200,
                'email'=> $admin->email,
                'token'=> $token,
                'id'=>$admin->id,
                'message'=>'Registered Successfully'
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|max:191',
            'password'=>'required'
       ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors'=> $validator->messages(),
            ]);
        } else {
            $admin = Admin::where('email', $request->email)->first();
 
            if (! $admin || ! Hash::check($request->password, $admin->password)) {
                return response()->json([
                'status' => 401,
                'message' => "Invalid Credentials"
            ]);
            } else {
                $token = $admin->createToken($admin->email.'_Token')->plainTextToken;
            
                return response()->json([
                'status'=>200,
                'email'=> $admin->email,
                'token'=> $token,
                'id'=> $admin->id,
                'name'=>$admin->name,
                'message'=>'Logged in Successfully'
            ]);
            }
        }
    }

    public function logout()
    {
        // auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged out Successfully'
        ]);
    }
}
