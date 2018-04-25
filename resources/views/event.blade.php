<!DOCTYPE html>
<html>
<head>
  <title>Events</title>
  <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
  <link rel="shortcut icon" href="{{URL::asset('favicon.ico')}}"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body class="register">

  <div id="nav">
    <ul>
      <li style="float:left;"><a href="../">Aston Events</a></li>
      <?php
        if(Auth::guest()){
          ?>
          <li><a href="../login">Log In</a></li>
          <li><a href="../register">Register</a></li>
        <?php
        }else {
        ?>
          <li><a href="../logout">Log out</a></li>
          <li><a href="{{ route('display_events') }}">My Events</a></li>
          <?php
        }
       ?>
      <li><a href="../events">Events</a></li>
    </ul>
  </div>

<div id="main" style="border-radius:10px; margin-top:10px;">
  <!--Display the event information from the object passed-->
  <h1>{{$event->name}}</h1>
   <img src="{{URL::asset($event->imgLoc)}}" height="250px" width="300px;" />

   <form method="post" action="{{action('EventController@like',$event->id)}}" onsubmit="return like()">
     <input type="hidden" value="{{csrf_token()}}" name="_token" />
     <input type="submit" id="toggle"class="button" name="submit" value="Like"/>
   </form>
   <h2>Likes: {{$event->likeness}}</h2>

   <ul>
     <li>When? {{$event->time}} on <?=date("F j, Y", strtotime(e($event->date)))?></li>
     <li>Where? {{$event->venue}}</li>
  </ul>
  <p>{{$event->description}}</p>
  <h3>Contact Organiser:{{$organiser->name}} {{$organiser->email}} {{$organiser->number}}</h3>
</div>

</body>

</html>
