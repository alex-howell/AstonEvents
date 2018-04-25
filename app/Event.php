<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  public $timestamps = false;

  public function saveEvent($data){
    //Save the event in the database
    $this->userid = auth()->user()->id;
    $this->name=$data['name'];
    $this->type=$data['type'];
    $this->date=$data['date'];
    $this->time=$data['time'];
    $this->imgLoc=$data['imgLoc'];
    $this->venue=$data['venue'];
    $this->description=$data['description'];
    $this->save();
    return 1;
  }

  public function updateEvent($data){

    //First find the event
    $event = $this->find($data['id']);
    //Then update its fields and save it
    $event->userid = auth()->user()->id;
    $event->name=$data['name'];
    $event->type=$data['type'];
    $event->date=$data['date'];
    $event->time=$data['time'];
    $event->imgLoc=$data['imgLoc'];
    $event->venue=$data['venue'];
    $event->description=$data['description'];
    $event->save();
    return 1;
  }

  public function updateLike($data){
    //Find the event and increment its likeness
    $event = $this->find($data['id']);
    $event->likeness++;
    $event->save();
    return 1;
  }

}
