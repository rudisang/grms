@extends('layouts.main')

@section('content')
<nav class="white">
  <div class="container">
      <div class="nav-wrapper">
          <a href="#!" class="breadcrumb teal-text">Dashboard</a>
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
                    <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Create Your Student Profile</a>
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
        
        <!-- Landlord Dashboard Views -->
           @if(Auth::user()->landlordaccount) 
              @if (Auth::user()->landlordaccount->status_id == 1)
                <div class="card-panel blue lighten-2">
                    <div class="white-text" role="alert">
                        🛈 Your Account is Under Review
                      </div>
                </div>
                @elseif(Auth::user()->landlordaccount->status_id == 2)
                        <!-- Approved -->
                <div class="fixed-action-btn">
                  <a class="btn-floating btn-large teal">
                    <i class="large material-icons">add</i>
                  </a>
                  <ul>
                    <li><a class="btn-floating teal"><i class="material-icons">home</i></a></li>
                    <li><a class="btn-floating teal"><i class="material-icons">mode_edit</i></a></li>
                  </ul>
                </div>
                <div class="row">
                  <div class="col s12">
                    <div class="card-panel">
                      <h5>My Listings</h5>
                    </div>
                  </div>
                </div>
                @elseif(Auth::user()->landlordaccount->status_id == 3)
                        <!-- Rejected -->
                        <div class="card-panel red lighten-1" >
                          <div class="white-text" role="alert">
                              <h5>🛈 Your Account has been rejected</h5>
                            </div>
                            
                      
                            <ul class="collapsible" style="border:none">
                              <li>
                                <div class="collapsible-header red lighten-1 white-text"><i class="material-icons white-text">info</i><strong>Reason</strong></div>
                                <div class="collapsible-body"><p class="white-text">Please make not of the requested changes and resubmit for review.</p>
                                  <p class="white-text">{{Auth::user()->landlordaccount->message}}</p></div>
                              </li>
                            </ul>
                     
                          
                      </div>

                      <x-admin-edit-user-account />

                @elseif(Auth::user()->landlordaccount->status_id == 4)
                        <!-- Suspended -->
                        <div class="card-panel yellow">
                          <div class="black-text" role="alert">
                              🛈 Your Account has been suspended
                            </div>
                      </div>
                @endif
           
           @else 
           <div class="card-panel blue lighten-2">
            <div class="white-text" role="alert">
                🛈 Almost There! Setup Your Landlord account inorder to get started. 
              </div>
            </div>
            <a href="/dashboard/account/create-landlord" class="btn teal pulse">Setup Account</a>
           @endif
             

           
            @elseif(Auth::user()->role_id == 3)
            <x-admin-user-table />

            <x-admin-landlord-table />
        @endif
    </section>
    
@endsection