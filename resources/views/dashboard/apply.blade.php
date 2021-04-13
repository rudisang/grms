@extends('layouts.main')

@section('content')
<nav class="white">
    <div class="container">
        <div class="nav-wrapper">
            <a href="/dashboard" class="breadcrumb indigo-text">{{Auth::user()->role->role}} Dashboard</a> 
            <a href="/jobs/{{$jobpost->id}}" class="breadcrumb indigo-text">Job Application</a>
            
        </div>
    </div>
</nav>
    <section class="container">
        <x-flash-messages />
    </section>

    <section class="container" style="margin-top:10px">
        <div class="card-panel" style="border-radius: 20px">
       
            <h4>{{$jobpost->title}}</h4>
            <p><strong>Closes {{date("F jS, Y", strtotime($jobpost->deadline))}}</strong></p>
        
          <form action="/apply/{{$jobpost->id}}" method="POST" enctype="multipart/form-data">
           
            @csrf
              <div class="row">
                      <div class="input-field col s12">
                        <p style="font-weight:bold">Application Cover</p>
                      <textarea name="cover" id="editor" class="materialize-textarea">{{old('cover')}}</textarea>
                        
                        @if ($errors->has('cover'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('cover') }}</strong>
                        </span>
                    @endif
                      </div>
              </div>
         
            <button href="#" class="btn indigo accent-1">Apply</button>
          </form>
        </div>
      </div>
    </section>
@endsection