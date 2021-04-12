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

    </ul>
  </div>

  <div class="container">
    <h3>Latest Job Posts</h3>
   
      @if($jobs->count() > 0)
      @php $posts = $jobs->sortByDesc('created_at'); @endphp
      <div class="row">
        @foreach ($posts as $job)
        <div class="col s12 m6">
         <div class="card white" style="border-radius:20px">
          <div class="card-content white-text">
            
            <span class="card-title black-text">{{$job->title}}</span>
            <p class="black-text">Application Deadline</p>
            <p class="btn indigo accent-1 z-depth-0">{{date("F jS, Y", strtotime($job->deadline))}}</p>
            <br><br>
            <a class="black-text" href="">{{$job->created_at->diffForHumans()}}</a><span class="black-text"> |</span>
            <a class="black-text view-btn" href="/jobs/{{$job->id}}">view</a>
          </div>
          <div class="card-action">
            <img style="width:30px;position:absolute;margin-top:-5px" class="circle responsive-img" src="{{asset('logos/'.$job->company->logo)}}" alt=""> <span style="margin-left:35px;font-weight:900" class="black-text">{{$job->company->name}}</span>@if($job->company->verified) <i class="material-icons blue white-text" style="font-size:10px;border-radius:100%">check</i>@endif

          </div>
        </div>
      </div>
         @endforeach
         <br>
      <!--   {{$jobs->links('/vendor/pagination/default')}} -->
      </div>
          
        @else
        <p class="grey-text center">No Job Posts Yet!</p>
      @endif
 
      
  </div>
@endsection