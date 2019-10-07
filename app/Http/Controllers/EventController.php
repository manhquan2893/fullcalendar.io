<?php
namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\ViewerEvent;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // the user who login is allowed event that user created
        $user_id=auth()->user()->id;
        $eventCreated= DB::table('events')
                ->join('users','events.user_id','=','users.id')
                ->where('user_id',$user_id)
                ->select('users.name as user_name','events.*')->get();

        // events that the user is allowed to see
        $eventViewed= DB::table('users as u')
                ->join('viewer_event','u.id','=','viewer_event.viewer_id')
                ->join('events','viewer_event.event_id','=','events.id')
                ->where('u.id','=',$user_id)
                ->join('users as uu','events.user_id','=','uu.id')
                ->select('uu.name as user_name','events.*')->get();
        $total_events=$eventCreated->merge($eventViewed);
        return $total_events;
        
    }
    public function store(Request $request)
    {
        // save viewers who can see that event
        $event= Event::create($request->except('viewerIds'));
        if(!empty($request->viewerIds)){
            $viewerIds=$request->viewerIds;
            foreach ($viewerIds as $viewerId) {
                ViewerEvent::create([
                    'viewer_id'=>$viewerId,
                    'event_id'=>Event::max('id')
                ]);
            }
        }
        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $event= Event::findOrFail($id);
        $event->update($request->except('viewerIds'));
        $viewer_events=ViewerEvent::where('event_id',$id)->get();
        foreach($viewer_events as $viewer_event){
            $viewer_event->delete();
        }
        if(!empty($request->viewerIds)){
            $viewerIds=$request->viewerIds;
            foreach ($viewerIds as $viewerId) {
                ViewerEvent::create([
                    'viewer_id'=>$viewerId,
                    'event_id'=>Event::max('id')
                ]);
            }
        }
        return $event;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $event= Event::findOrFail($id);
        $event->delete();
    }
}
