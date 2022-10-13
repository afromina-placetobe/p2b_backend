<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class eventController extends Controller
{
    //
    public function addEvent(Request $request)
    {
        $event = new Event;
        $file= $request->file('event_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('assets/'), $filename);
        $event->event_status = $request->event_status;
        $event->userId = $request->userId;
        $event->event_image = $filename;
        $event->event_name = $request->event_name;
        $event->event_description = $request->event_description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->category = $request->category;
        $event->event_organizer = $request->event_organizer;
        $event->event_venue = $request->event_venue;
        $event->event_address = $request->event_address;
        $event->address_latitude = $request->address_latitude;
        $event->address_longitude = $request->address_longitude;
        $event->contact_phone = $request->contact_phone;
        $event->redirectUrl = $request->redirectUrl;
        $event->event_entrance_fee = $request->event_entance_fee;
        $event->save();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }

    public function editEvent(Request $request)
    {
        $id=$request->event_id;
        // $event = DB::table('events')->where('event_id', $request->event_id)->get();
        $event = Event::where('event_id','=',$id)->firstOrFail();
        // return $event;
        $event->event_status = $request->event_status;
        $event->event_image = $request ->event_image;
        $event->event_name = $request->event_name;
        $event->event_description = $request->event_description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->category = $request->category;
        $event->event_organizer = $request->event_organizer;
        $event->event_venue = $request->event_venue;
        $event->event_address = $request->event_address;
        $event->address_latitude = $request->address_latitude;
        $event->address_longitude = $request->address_longitude;
        $event->contact_phone = $request->contact_phone;
        $event->redirectUrl = $request->redirectUrl;
        $event->event_entrance_fee = $request->event_entance_fee;
        $event->save();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }

    public function deleteEvent(Request $request)
    {
        $id=$request->event_id;

        $event = Event::where('event_id','=',$id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>'success'
        ]);
    }

    public function showSingleEvent(Request $request)
    {
        $id=$request->event_id;

        $event = Event::where('event_id','=',$id)->first();
        if($event)
        {
        return response()->json([
            'status'=>200,
            'event'=> $event
        ]);
    }
    else{
        return response()->json([
            'status'=>404,
            'message'=>"No Id Found"
        ]);
    }
    }
    public function approvedEvent(Request $request)
    {
        $event=Event::where('event_status', '=', 1)->get(); 
        return response()->json([
            'status'=>200,
            'event'=>$event
        ]); 
    }

    public function publishEvent(Request $request)
    {
        $id=$request->event_id;

        $event = Event::where('event_id','=',$id)->update(['event_status' => 1]);
        
        // $event->event_status = 1;
        // $event->update();
        // return $event;
        return response()->json([
            'status'=>200,
            'message'=>"Event Published Successfully"
        ]); 
    }
    public function pendingEvent(Request $request)
    {
        $event=Event::where('event_status', '=', 0)->get(); 
        return response()->json([
            'status'=>200,
            'event'=>$event
        ]); 
    }

    public function declinedEvent(Request $request)
    {
        $event=Event::where('event_status', '=', 2)->get(); 
        return response()->json([
            'status'=>200,
            'event'=>$event
        ]); 
    }
    
    public function upcomingEvent(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $event = Event::where('start_date','>',$todayDate)->where('event_status','=',1)->get();
        return response()->json([
            'status'=>200,
            'event'=>$event
        ]); 
    }

    public function expiredEvent(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $event = Event::where('start_date','<',$todayDate)
        ->where('end_date','<',$todayDate)
        ->where('event_status','=',1)->get();
        return response()->json([
            'status'=>200,
            'event'=>$event
        ]); 
    }

    public function todaysEvent(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $tomorrowDate = Carbon::tomorrow()->format('Y-m-d');
        $event = Event::where(function ($query) {
            $query->where('start_date', '=', $todayDate)
                  ->orWhere('start_date', '>', $todayDate);})
                  ->where('end_date','<',$tomorrowDate)->get();

        return response()->json([
        'status'=>200,
        'event'=>$event
        ]);
    }

    public function latestEvent(Request $request)
    {
        $weekEndDate = Carbon::now()->addDays(7);
        $event = Event::where('start_date','>',$weekEndDate)
        ->where('event_status','!=',2)->get();

        return response()->json([
            'status'=>200,
            'event'=>$event
            ]);
    }
}
