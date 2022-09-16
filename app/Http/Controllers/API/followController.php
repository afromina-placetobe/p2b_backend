<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;
class followController extends Controller
{
    //
    public function addFollow(Request $request)
    {
        $follow = new Follow;
        $follow->follower_id = $request->follower_id;
        $follow->followed_id = $request->followed_id;
        $follow->save();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }
   
    public function editFollow(Request $request)
    {
        $follow = Follow::find($request->follow_id);
        $follow->follower_id = $request->follower_id;
        $follow->followed_id = $request->followed_id;
        $follow->save();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }
    
    public function deleteFollow(Request $request)
    {
        $follow = Follow::findOrFail($request->follow_id);
        $follow->delete();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }
    
    public function showFollow(Request $request) {
        $follow = Follow::all();
        return response()->json([
            'follow'=>$follow,
            'status'=>200
        ]);
    }
}
