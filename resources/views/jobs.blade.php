@extends('layouts.main')
@section('content')
<div class="container" style="margin-bottom:10px">
  <div class="card-panel z-depth-0 grey lighten-4">
      <form action="/jobs" method="get">
          <input type="search" placeholder="search job" name="search" id="">
      </form>
  </div>
</div>
  <div class="container">
    
        <div class="row">
            @if($jobs->count() > 0)
            @php $posts = $jobs->sortByDesc('created_at'); @endphp
            <div class="row">
              @foreach ($posts as $job)
              <div class="col s12 m6">
               <div class="card white" style="border-radius:20px">
                <div class="card-content white-text">
                  
                  <span class="card-title black-text" style="font-weight: bold !important"><a class="card-title black-text" href="/jobs/{{$job->id}}">{{$job->title}}</a></span>
             
                  <a class="black-text">Applications Close: <span  style="text-decoration: underline;font-weight:bold">{{date("F jS, Y", strtotime($job->deadline))}}</span></a>
              
                  <span class="black-text"> |</span>
                  <a class="indigo-text view-btn" href="/jobs/{{$job->id}}">view</a>
                </div>
                <div class="card-action">
                  <img style="width:30px;position:absolute;margin-top:-5px" class="circle responsive-img" src="{{asset('logos/'.$job->company->logo)}}" alt=""> <span style="margin-left:35px;font-weight:900" class="black-text">{{$job->company->name}}</span>@if($job->company->verified) <i class="material-icons blue white-text" style="font-size:10px;border-radius:100%">check</i>@endif
                  <a class="white-text right btn indigo accent-1 z-depth-0" href="" style="margin-top: -5px">{{$job->created_at->diffForHumans()}}</a>
                </div>
              </div>
            </div>
               @endforeach
               <br>
            <!--   {{$jobs->links('/vendor/pagination/default')}} -->
            </div>
                
              @else
              <h4 class="grey-text center">Looks Like There's Nothing Here!</h4>
              <img src="{{asset('images/nothing.png')}}" style="display: block;margin:auto" alt="">
            
            @endif
       
      </div>

      
  </div>
@endsection