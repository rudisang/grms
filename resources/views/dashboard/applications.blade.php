@extends('layouts.main')

@section('content')
<nav class="white">
    <div class="container">
        <div class="nav-wrapper">
            <a href="/dashboard" class="breadcrumb indigo-text">{{Auth::user()->role->role}} Dashboard</a> 
            <a href="/dashboard" class="breadcrumb indigo-text">Applications</a>

        </div>
    </div>
</nav>
    <section class="container">
        <x-flash-messages />
    </section>

    <section class="container" style="margin-top:10px">
        <div class="card-panel" style="border-radius:20px">
            @if ($jobpost->applications->count() > 0)
            <table>
              <thead>
                <tr>
                    
                    <th>Applicant</th>
                    <th>Date Applied</th>
                    <th>Status</th>
                    <th></th>
                </tr>
              </thead>
      
              <tbody>
                @foreach($jobpost->applications as $app)
                   
                <tr>
                  <td>{{$app->user->name}} {{$app->user->surname}}</td>
                  <td>{{$app->created_at->diffForHumans()}}</td>
                  <td>@if($app->status == 1)
                      <span class="btn green black-text">Received</span>
                      @else
                      <span class="btn amber">Submited</span>
                      @endif
                  </td>
                  <td> @if ($app->status)
                    <a href="" class="btn indigo accent-1">View</a>
                    @else
                    <a href="" class="btn indigo accent-3">View</a>
                  @endif</td>
                 
                </tr>
                

              @endforeach
                
              </tbody>
            </table>
            @endif
      </div>
    </section>
@endsection