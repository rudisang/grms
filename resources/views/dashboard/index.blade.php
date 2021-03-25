@extends('layouts.main')

@section('content')
<nav class="white">
  <div class="container">
      <div class="nav-wrapper">
          <a href="#!" class="breadcrumb indigo-text">Dashboard</a>
      </div>
  </div>
</nav>

    <section class="container">
      <x-flash-messages />
    </section>

    <section class="container">
        @if(Auth::user()->role_id == 1)
        <!-- Student Dashboard Views -->
            <h3>Hi {{Auth::user()->name}}!!</h3>
            <div class="row">
                <div class="col s12">
                  <div class="card-panel">
                    <a class="waves-effect waves-light btn modal-trigger indigo" href="#modal1">Create Your Graduate Profile</a>
                  </div>
                </div>
              </div>
           

            <!-- Modal Structure -->
            <div id="modal1" class="modal">
              <div class="modal-content">
                <h4>Student Form</h4>
                <x-student-form />
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
              </div>
            </div>

        @elseif(Auth::user()->role_id == 2)
        
            @if(Auth::user()->company)
              <a href="" class="btn indigo">Create Job Post</a>

              <div class="row">
                <div class="card-panel" style="padding:10px">
                  <h5>My Job Posts</h5>
                </div>
              </div>
            @else
            <div class="card-panel blue lighten-2">
              <div class="white-text" role="alert">
                  🛈 Almost There! Setup Your Recruiter account inorder to get started. 
                </div>
              </div>
              <a href="/dashboard/create-company" class="btn indigo pulse">Setup Account</a>
     
            @endif
             

           
            @elseif(Auth::user()->role_id == 3)
            <x-admin-user-table />

   
        @endif
    </section>
    
@endsection