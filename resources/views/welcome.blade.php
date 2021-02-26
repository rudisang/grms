@extends('layouts.main')
@section('content')
<div class="slider">
    <ul class="slides">
      <li>
        <img class="dim" src="{{asset('images/slider3.jpg')}}"> <!-- random image -->
        <div class="caption center-align">
          <h3>The Best & Most!</h3>
          <h5 class="light grey-text text-lighten-3">Affordable Student Housing.</h5>
        </div>
      </li>
      <li>
        <img class="dim" src="{{asset('images/slider1.jpg')}}"> <!-- random image -->
        <div class="caption left-align">
          <h3>Student Rooms</h3>
          <h5 class="light grey-text text-lighten-3">Single Rooms or To Share.</h5>
        </div>
      </li>
      <li>
        <img class="dim" src="{{asset('images/slider2.jpg')}}"> <!-- random image -->
        <div class="caption right-align">
          <h3>Convenient Location</h3>
          <h5 class="light grey-text text-lighten-3">Access public transport without a hassle.</h5>
        </div>
      </li>
    </ul>
  </div>

  <div class="container">
    
      
  </div>
@endsection