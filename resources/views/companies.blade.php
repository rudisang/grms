@extends('layouts.main')
@section('content')
<div class="container" style="margin-bottom:10px">
  <div class="card-panel z-depth-0 grey lighten-4">
      <form action="/search/company" method="get">
          <input type="search" placeholder="search company" name="search" id="">
      </form>
  </div>
</div>
  <div class="container">
    
        <div class="row">
          @if($companies->count() > 0)
          @foreach($companies as $company)
              <div class="col s12 m4">
                <div class="card" style="border-radius:20px">
                  <div class="card-image" >
                    <img class="materialboxed dim" src="{{asset('covers/'.$company->cover)}}" style="border-radius:20px 20px 0px 0px">
                    <span class="card-title"> {{$company->name}} @if($company->verified)<i class="material-icons blue" style="font-size:15px;border-radius:100%">check</i>@endif</span>
                  <a class="btn-floating halfway-fab waves-effect waves-light white"><img class="materialboxed" src="{{asset('logos/'.$company->logo)}}" alt=""></a>
                  </div>
                  <div class="card-content">
                 @guest
                     @else
                     @if($company->user_id == Auth::user()->id) <a href="/dashboard/edit-company/{{$company->id}}" class="btn amber">edit</a>@endif
                 @endguest
                  <a href="/companies/{{$company->id}}" class="btn indigo accent-1">view</a>
                  </div>
                </div>
              </div>
           
          @endforeach

          @else
          <h4 class="grey-text center">Looks Like There's Nothing Here!</h4>
          <img src="{{asset('images/nothing.gif')}}" style="display: block;margin:auto" alt="">
        
        @endif
      </div>

      
  </div>
@endsection