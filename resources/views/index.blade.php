<!DOCTYPE html>
<html>
<head>
  <title>Aston Events</title>
  <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
  <link rel="shortcut icon" href="{{URL::asset('favicon.ico')}}"/>
  <link rel="stylesheet" href="{{URL::asset('backgroundStyle.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script src="{{URL::asset('js/backgroundScript.js')}}"></script>
  <link rel="shortcut icon" href="{{URL::asset('favicon.ico')}}"/>
</head>

<body>

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

<div id="mainHome">
  <h1>Welcome to Aston Events</h1>
  <h3>Your place for all the information you need regarding the latest events at Aston University.</h1>
  <a class="button" href="events">Events</a>
</div>

</body>

</html>
