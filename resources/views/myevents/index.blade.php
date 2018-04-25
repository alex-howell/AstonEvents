<html>
<head>
  <title>My Events</title>
  <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
  <link rel="shortcut icon" href="{{URL::asset('favicon.ico')}}"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body class="myEvents">
  <div id="nav">
    <ul>
      <li style="float:left;"><a href="./">Aston Events</a></li>
      <?php
        if(Auth::guest()){
          ?>
          <li><a href="login">Log In</a></li>
          <li><a href="register">Register</a></li>
        <?php
        }else {
        ?>
          <li><a href="logout">Log out</a></li>
          <li><a href="{{ route('display_events') }}">My Events</a></li>
          <?php
        }
       ?>
      <li><a href="events">Events</a></li>
    </ul>
  </div>
  <div id="main" style="width:65%;">
         @if (session('status'))
         <div class="alert alert-success">
           {{ session('status') }}
         </div>
         @endif

         <table class="table table-striped table-bordered table-hover" style="padding:10px;">
           <thead>
             <tr>
               <th> Event ID</th><th> Event Name</th><th> Type</th>
               <th> Date </th><th> Time </th><th> Venue</th>
               <th> Popularity </th><th>Actions</th>
             </tr>
           </thead>
           <tbody>
             <!--Display all the events that match the organiser id--->
             @foreach($events as $event)
             <tr>
               <td> {{$event->id}} </td>
               <td> {{$event->name}} </td>
               <td> {{$event->type}} </td>
               <td> {{$event->date}} </td>
               <td> {{$event->time}} </td>
               <td> {{$event->venue}} </td>
               <td> {{$event->likeness}}</td>
               <td><a href="myevents/edit/{{$event->id}}" >Edit</a> <a href="myevents/delete/{{$event->id}}" onclick="return confirm('Click OK if you are sure you would like to delete the event.')">Delete</a></td>
             </tr>
             @endforeach
           </tbody>
         </table>
         <a href="myevents/create" class="button">Add Event</a><br/>
       </div>
     </div>
</body>
</html>
