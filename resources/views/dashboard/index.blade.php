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
            <h2>I am a landlord yaay</h2>
        @endif
    </section>
    
@endsection