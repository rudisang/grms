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
            <h2>I am a student yaay</h2>
            <h2>{{Auth::user()->role->role}}</h2>

        @elseif(Auth::user()->role_id == 2)
        <!-- Landlord Dashboard Views -->
            <h2>I am a landlord yaay</h2>
        @endif
    </section>
    
@endsection