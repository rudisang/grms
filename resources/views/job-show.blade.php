@extends('layouts.main')
@section('content')
<div class="slider">
        <ul class="slides">
    
          <li>
            <img class="dim" src="{{asset('covers/no_cover.jpg')}}"> <!-- random image -->
            <div class="caption center-align">
                    <img style="width:140px" class="circle responsive-img" src="{{asset('logos/'.$job->company->logo)}}" alt="">
              <h3>{{$job->title}} @if($job->company->verified)<i class="material-icons blue" style="padding:3px;border-radius:100%">check</i>@endif</h3>
              @php $date_now = date("Y-m-d"); @endphp

              @if($date_now > $job->deadline)
              <a href="" class="btn red z-depth-0" disabled>Application Closed</a>
              @else
               @guest
               <a href="/login" class="btn indigo accent-1">login to apply</a>
                   @else
                   @if (Auth::user()->role_id == 1)
                        <a href="" class="btn blue">Apply</a>
                   @endif
               @endguest
              @endif
             
            </div>
          </li>
    
        </ul>
      </div>
    
  <div class="container">
       <div class="card-panel" style="border-radius: 20px">
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

  <div class="container">
 
        <div class="row">
          <br>
          <hr>
         
          <h5 style="margin-left: 20px">Similar Job Posts</h5>
          @foreach ($jobs as $post)
          @if ($job->id == $post->id)
            
          @else
          <div class="col s12 m6">
            <div class="card white" style="border-radius:20px">
             <div class="card-content white-text">
               
               <span class="card-title black-text" style="font-weight: bold !important"><a class="card-title black-text" href="/jobs/{{$post->id}}">{{$post->title}}</a></span>
          
               <a class="black-text">Applications Close: <span  style="text-decoration: underline;font-weight:bold">{{date("F jS, Y", strtotime($post->deadline))}}</span></a>
           
               <span class="black-text"> |</span>
               <a class="indigo-text view-btn" href="/jobs/{{$post->id}}">view</a>
             </div>
             <div class="card-action">
               <img style="width:30px;position:absolute;margin-top:-5px" class="circle responsive-img" src="{{asset('logos/'.$post->company->logo)}}" alt=""> <span style="margin-left:35px;font-weight:900" class="black-text">{{$post->company->name}}</span>@if($post->company->verified) <i class="material-icons blue white-text" style="font-size:10px;border-radius:100%">check</i>@endif
               <a class="white-text right btn indigo accent-1 z-depth-0" href="" style="margin-top: -5px">{{$post->created_at->diffForHumans()}}</a>
             </div>
           </div>
         </div>
          @endif
           @endforeach
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