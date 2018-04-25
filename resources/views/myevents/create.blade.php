@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
    <div class="row">
    <form method="post" action="{{url('/myevents/create')}}" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Event Name:</label>
            <input type="text" class="form-control" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}"/>
        </div>

        <div class="form-group">
          <label for="type">Type:</label>
            <select name="type">
              <option value="Sport">Sport</option>
              <option value="Culture">Culture</option>
              <option value="Other">Other</option>
            </select>

        </div>

        <div class="form-group">
            <label for="time">Event Time:</label>
            <input type="time" class="form-control" name="time" step="1" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" value="{{ old('time') }}"/>
        </div>

        <div class="form-group">
            <label for="date">Event Date:</label>
            <input type="date" class="form-control" name="date"class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{ old('date') }}"/>
        </div>



        <div class="form-group">
            <label for="description">Event Description:</label>
            <textarea cols="5" rows="5" class="form-control" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Event Venue</label>
            <input type="text" class="form-control" name="venue" class="form-control{{ $errors->has('venue') ? ' is-invalid' : '' }}" value="{{ old('venue') }}"/>
        </div>

        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" class="form-control" name="image"/>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection
