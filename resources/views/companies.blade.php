@extends('layouts.main')
@section('content')
<div class="container" style="margin-bottom:10px">
  <div class="card-panel">
      <form action="/search/company" method="get">
          <input type="search" placeholder="search company" name="search" id="">
      </form>
  </div>
</div>
  <div class="container">
    
        <div class="row">
          @foreach($companies as $company)
              <div class="col s12 m4">
                <div class="card">
                  <div class="card-image">
                    <img src="{{asset('images/company_bg.jpg')}}">
                    <span class="card-title"> {{$company->name}} @if($company->verified)<i class="material-icons blue" style="font-size:15px;border-radius:100%">check</i>@endif</span>
                  <a class="btn-floating halfway-fab waves-effect waves-light white"><img src="{{asset('logos/'.$company->logo)}}" alt=""></a>
                  </div>
                  <div class="card-content">
                 @guest
                     @else
                     @if($company->user_id == Auth::user()->id) <a href="" class="btn amber">edit</a>@endif
                 @endguest
                  <a href="/companies/{{$company->id}}" class="btn indigo accent-1">view</a>
                  </div>
                </div>
              </div>
           
          @endforeach
      </div>

      
  </div>
@endsection