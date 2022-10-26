<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //
    public function addUser(Request $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->profile = $request->profile;
        $user->category = $request->category;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->signup_date = $request->signup_date;
        $user->authentication_key = $request->authentication_key;
        $user->status = $request->status;
        $user->save();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }

    public function editUser(Request $request)
    {
        $user = User::find($request->userId);
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->profile = $request->profile;
        $user->category = $request->category;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->signup_date = $request->signup_date;
        $user->authentication_key = $request->authentication_key;
        $user->status = $request->status;
        $user->save();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->userId);
        $user->delete();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }

    public function showSingleUser(Request $request)
    {
        $user = User::find($request->userId);
        return response()->json([
            'status'=>200,
            'user'=> $user
        ]);
    }

    public function showUser(Request $request) {
        $user = User::all();
        return response()->json([
            'user'=>$user,
            'status'=>200
        ]);
    }

    public function showUsername(Request $request) {
        $user = User::get(['username']);
        // $username = $user->username;
        return response()->json([
            'user'=>$user,
            'status'=>200
        ]);
    }
}
