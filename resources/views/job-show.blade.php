@extends('layouts.main')
@section('content')
<div class="slider">
        <ul class="slides">
    
          <li>
            <img class="dim" src="{{asset('images/company_bg.jpg')}}"> <!-- random image -->
            <div class="caption center-align">
                    <img style="width:140px" class="circle responsive-img" src="{{asset('logos/'.$job->company->logo)}}" alt="">
              <h3>{{$job->title}} @if($job->company->verified)<i class="material-icons blue" style="padding:3px;border-radius:100%">check</i>@endif</h3>
              @php $date_now = date("Y-m-d"); @endphp

              @if($date_now > $job->deadline)
              <a href="" class="btn red z-depth-0" disabled>Application Closed</a>
              @else
              <a href="" class="btn blue">Apply</a>
              @endif
             
            </div>
          </li>
    
        </ul>
      </div>
    
  <div class="container">
       <div class="card-panel">
           <div class="row">
               <div class="col s12 m4">
                <h5>Application Deadline</h5>
                <p id="demo" class="btn z-depth-0 green accent-3 black-text" style="font-weight:900">{{$job->deadline}}</p>
               </div>
               <div class="col s12 m4">
                <h5>Category</h5>
                <p class="btn z-depth-0 indigo accent-1">{{$job->category->name}}</p>
               </div>
               <div class="col s12 m4">
                <h5>Job Type</h5>
                <p class="btn z-depth-0 indigo accent-1">{{$job->position}}</p>
               </div>
           </div>
          
            <h5>Job Description</h5>
            <p>{{$job->details}}</p>
       </div>
  </div>

  <script>
    // Set the date we're counting down to
    var countDownDate = new Date(<?php echo json_encode($job->deadline); ?>).getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
    
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
      // Display the result in the element with id="demo"
      document.getElementById("demo").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
    
      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Application Closed";
        document.getElementById("demo").classList.remove("green");
        document.getElementById("demo").classList.remove("accent-1");
        document.getElementById("demo").classList.add("red");
      }
    }, 1000);
    </script>

@endsection