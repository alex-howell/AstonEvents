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
      <li style="float:left;"><a href="./">Aston Events</a></li>
      <!--Display different navigation bar depending on whether they are logged in or not-->
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

<div id="main">
  <h1>Events</h1>
  <p>See Below A List of Current Events</p>
  <form method="POST" action="{{url('events')}}">
    <div class="form-group">
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
        <label for="All">
          <input type="radio" name="type" value="All" clase="form-control" checked> All
        </label>
        <label for="Sport">
          <input type="radio" name="type" value="Sport" clase="form-control"> Sport
        </label>
        <label for="Culture">
          <input type="radio" name="type" value="Culture" clase="form-control"> Culture
        </label>
        <label for="Other">
          <input type="radio" name="type" value="Other" clase="form-control"> Other
        </label><br/><br/>
        <label for="sort">Order By
        <select name="sort">
          <option value="date">Closest</option>
          <option value="name">Name</option>
          <option value="popularity">Popularity</option>
        </select>
        </label>
        <br/><br/>
        <label for="date1">From:
          <input type="date" name="date1" />
        </label>
        <label for="date2">To:
          <input type="date" name="date2" />
        </label>
    </div><br/>
    <button type="submit" class="btn btn-primary">Filter</button>
  </form>
<!-- loop through displaying every event-->
  @foreach($events as $event)
 <div class="event">
   <img src="{{URL::asset($event->imgLoc)}}" height="150px" width="175px;" style="float:left;"/>
   <h3>{{$event->name}}</h3>
   <!-- convert the date format to a more user friendly one-->
   <h4><?=date("F j, Y", strtotime(e($event->date)))?> at {{$event->time}}</h4>
   <p style="float:right;">{{$event->description}}<p>
    <h4>Likes: {{$event->likeness}}</h4> <a href="event/{{$event->id}}" class="button">Find Out More</a><br/><br/>
 </div>
 @endforeach

</div>

</body>

</html>
