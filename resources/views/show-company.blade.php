@extends('layouts.main')
@section('content')
<div class="slider">
        <ul class="slides">
    
          <li>
            <img class="dim" src="{{asset('covers/'.$company->cover)}}"> <!-- random image -->
            <div class="caption center-align">
                    <img style="width:140px" class="circle responsive-img" src="{{asset('logos/'.$company->logo)}}" alt="">
              <h3>{{$company->name}} @if($company->verified)<i class="material-icons blue" style="padding:3px;border-radius:100%">check</i>@endif</h3>
              <h5 class="light grey-text text-lighten-3">  <a class="waves-effect waves-light btn modal-trigger indigo accent-1" href="#modal1">company details</a></h5>
            </div>
          </li>
    
        </ul>
      </div>
    
  <div class="container">
        <!-- Modal Trigger -->


  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
     <div class="container">
            <h5>Details</h5>
            <hr>
                  <span><strong style="font-weight:bold">Email:</strong> {{$company->email}}</span><br>
                  <span><strong style="font-weight:bold">Physical Address:</strong> {{$company->physical_address}}</span><br>
                  <span><strong style="font-weight:bold">Postal Address:</strong> {{$company->postal_address}}</span><br>
                  <span><strong style="font-weight:bold">Phone Number:</strong> {{$company->phone}}</span><br>
            <hr>
                  <p>Bio</p>
                  <span>{{$company->bio}}</span>
     </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat indigo accent-1">close</a>
    </div>
  </div>
  <h5>Job Posts</h5>
      <div class="card-panel z-depth-0" style="border-radius:20px">
      
           
            @if($company->jobposts->count() > 0)
            <div class="row">
              @foreach ($company->jobposts as $job)
              <div class="col s12 m6">
               <div class="card grey lighten-3 z-depth-0" style="border-radius:20px">
                <div class="card-content white-text">
                  
                  <span class="card-title black-text">{{$job->title}}</span>
                  <p class="black-text">Application Deadline</p>
                  <p class="btn indigo accent-1 z-depth-0">{{date("F jS, Y", strtotime($job->deadline))}}</p>
                
                </div>
                <div class="card-action">
                  <a class="black-text" href="">{{$job->created_at->diffForHumans()}}</a>
                  <a class="black-text" href="/jobs/{{$job->id}}">view</a>
                </div>
              </div>
            </div>
               @endforeach
            </div>
                
              @else
              <p class="grey-text center">No Job Posts Yet!</p>
            @endif

          </div>
  </div>


  </div>
@endsection