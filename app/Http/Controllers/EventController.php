<?php

namespace App\Http\Controllers;

use App\Models\AdminModal;
use App\Models\EventModal;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    function index()
    {
        $tmpEvents = EventModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();
        $events = array();
        $tmpValue = array();
        foreach ($tmpEvents as $tmpEvent) {
            $tmpValue['id'] = $tmpEvent->id;
            $tmpValue['title'] = $tmpEvent->title;
            $tmpValue['description'] = $tmpEvent->description;
            $tmpValue['starting_date'] = $tmpEvent->starting_date;
            $tmpValue['ending_date'] = $tmpEvent->ending_date;
            $tmpValue['full_day'] = $tmpEvent->full_day;
            $tmpValue['created_at'] = $tmpEvent->created_at;
            $tmpValue['created_by'] = $tmpEvent->created_by;
            $adminDetails = AdminModal::find($tmpEvent->created_by);
            $tempCompanysArray['created_by_name'] = $adminDetails->name;
            $tmpValue['deleted_at'] = $tmpEvent->deleted_at;
            $tmpValue['deleted_by'] = $tmpEvent->deleted_by;
            $tmpValue['status'] = $tmpEvent->status;

            array_push($events, $tmpValue);
        }
        return view('event', compact('events'));
    }


    function addEvent(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required ',
            'description' => 'required ', 
            'starting_date' => 'required ', 
            'ending_date' => 'required ',
            'full_day' => 'required'

        ]);
        
        $event = new EventModal();

        $event->title = $request->title;
        $event->description = $request->description;
        $event->starting_date = $request->starting_date;
        $event->ending_date = $request->ending_date;
        $event->full_day = $request->full_day;
        $event->created_by = 1; //$request->session()->get('event_id'); 
        $event->save();

        return response()->json($event);
    }

    function detailsOfEvent($id)
    { 
        $event = EventModal::find($id);
        return response()->json($event);
    }

    function updateEvent(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required ',
            'description' => 'required ', 
            'starting_date' => 'required ', 
            'ending_date' => 'required',
            'full_day' => 'required'
        ]);

        $eventToUpdate = EventModal::find($request->id);
        $eventToUpdate->title = $request->title;
        $eventToUpdate->description = $request->description;
        $eventToUpdate->starting_date = $request->starting_date;
        $eventToUpdate->ending_date = $request->ending_date;
        $eventToUpdate->full_day = $request->full_day;
        $eventToUpdate->save();
        return response()->json($eventToUpdate);
    }

    function deleteEvent(Request $request)
    {
        $extraToDelete = EventModal::find($request->id);
        $extraToDelete->deleted_at = date('Y-m-d H:i:s');
        $extraToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $extraToDelete->status = 0;
        $extraToDelete->save();
        return response()->json($extraToDelete);
    }
}
