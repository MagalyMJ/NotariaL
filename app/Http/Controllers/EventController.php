<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;
use NotiAPP\Models\Event;

class EventController extends Controller
{
    
    public function index()
    {

        $calendar = \Calendar::addEvents(Event::all()); //add an array with addEve

        return view('event/index', compact('calendar'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        return view('event/list', ['events' => Event::orderBy('start')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('event/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $time = explode(" - ", $request->time);

         $event = new Event;
         $event->name = $request->name;
         $event->title = $request->title;
         $event->start = $time[0];
         $event->end = $time[1];

         $event->save();

         $request->session()->flash('success', 'The event was successfully saved!');
        return Redirect::route('calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('event/view', ['event' => Event::findOrFail($id)]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('event/edit', ['event' => Event::findOrFail($id)]);

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
        $time = explode(" - ", $request->input('time'));
          
         $event = Event::findOrFail($id);
         $event->name = $request->input('name');
         $event->title = $request->input('title');
         $event->start = new \DateTime($time[0]);
         $event->end = new \DateTime($time[1]);
         $event->save();
          
        return Redirect::route('calendar');
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
         $event = Event::find($id);
         $event->delete();
          
        return Redirect::route('calendar');
    }
}
