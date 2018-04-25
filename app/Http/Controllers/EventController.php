<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Gate;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $eventQuery = Event::all();
      if (Gate::denies('displayAll')) {
       //Only get the events that match the current users ID
       $eventQuery=$eventQuery->where('userid', auth()->user()->id);
      }
       return view('myevents.index', array('events'=>$eventQuery));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('myevents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();

        //Validate the form input
        $data = $this->validate($request,[
          'name'=>'required',
          'description'=>'required',
          'type'=>'required',
          'venue'=>'required',
          'date'=>'required|date|after:today',
          'time'=>'required',
          'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $image = $request->file('image');

        //Rename the uploaded file
        $new_name = $request['name'].'_'.$request['date'].'_'.$request['venue'].'.'.$image->getClientOriginalExtension();
        //Move the image to the desired directory
        $image->move(public_path('eventImg'),$new_name);

        $data['imgLoc'] = 'eventImg/'.$new_name;

        $event->saveEvent($data);
        return redirect('/myevents')->with('new event added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event= Event::where('userid',auth()->user()->id)->where('id',$id)->first();
        return view('myevents.edit',compact('event', 'id'));
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
      $event = new Event();
      $data = $this->validate($request,[
        'name'=>'required',
        'description'=>'required',
        'type'=>'required',
        'venue'=>'required',
        'date'=>'required|date|after:today',
        'time'=>'required',
        'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
      ]);

      $image = $request->file('image');
      $new_name = $request['name'].'_'.$request['date'].'_'.$request['venue'].'.'.$image->getClientOriginalExtension();
      $image->move(public_path('eventImg'),$new_name);

      $data['imgLoc'] = 'eventImg/'.$new_name;

      $data['id'] = $id;
      $event->updateEvent($data);

      return redirect('/myevents');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //Delete the event that matches the passed id
        $event = Event::find($id);
        $event->delete();

        return redirect('/myevents')->with('success', 'Event has been deleted.');
    }

    public function show($id){
      //find the event and organiser
      $event = Event::find($id);
      $organiser = User::find($event->userid);

      return view('/event', array('event' => $event), array('organiser'=>$organiser));
    }

    public function like(Request $request, $id)
    {
      $event = new Event();
      $data = $this->validate($request,[
        'submit'=>'required'
      ]);
      $data['id'] = $id;
      //Update the likes
      $event->updateLike($data);

      $event = Event::find($id);
      $organiser = User::find($event->userid);

      return view('/event', array('event' => $event), array('organiser'=>$organiser));
    }

    public function events(){
      $eventFilter = Event::all();
      //Filter out events that have already passsed
      $eventFilter = $eventFilter->where('date','>',date("Y-m-d"));
      return view('/events', array('events'=>$eventFilter));
    }

    public function filter(Request $request){

      $eventFilter = Event::all();
      $eventFilter = $eventFilter->where('date','>',date("Y-m-d"));
      //Automatically sort them by date
      $eventFilter = $eventFilter->sortBy('date');

      if($request['date1']!=null && $request['date2']!=null){
        //See if an event is between the two dates
        $eventFilter = $eventFilter->where('date','>=',$request['date1']);
        $eventFilter = $eventFilter->where('date','=<',$request['date2']);
      }
      if($request['type']!='All'){
        $eventFilter = $eventFilter->where('type',$request['type']);
      }
      //Sort the results depending on users choice
      if($request['sort']=='name'){
        $eventFilter = $eventFilter->sortBy('name');
      }
      if($request['sort']=='popularity'){
        $eventFilter = $eventFilter->sortBy('likeness', SORT_REGULAR, true);
      }
      return view('/events', array('events'=>$eventFilter));
    }




}
