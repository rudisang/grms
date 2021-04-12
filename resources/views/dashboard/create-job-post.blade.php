@extends('layouts.main')

@section('content')
<nav class="white">
    <div class="container">
        <div class="nav-wrapper">
            <a href="/dashboard" class="breadcrumb indigo-text">{{Auth::user()->role->role}} Dashboard</a> 
            <a href="/dashboard" class="breadcrumb indigo-text">Recruiter</a>
            <a class="breadcrumb grey-text">Job Post</a>
        </div>
    </div>
</nav>
    <section class="container">
        <x-flash-messages />
    </section>

    <section class="container" style="margin-top:10px">
        <div class="card-panel">
       
            <h4>Job Post</h4>
        
          <form action="/dashboard/job-post/create" method="POST" enctype="multipart/form-data">
           
            @csrf
  
              <div class="row">
                <div class="input-field col s12 m6">
                  <input name="title" id="disabled" value="{{old('title')}}" type="text" class="validate" required>
                  <label for="disabled">Job Title</label>
                            @if ($errors->has('title'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                </div>

                
                <div class="input-field col s12 m6">
                    <select name="category_id" style="display: block" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $item)
                           <option value="{{ $item->id}}"> {{ $item->name }}</option>
                        @endforeach
                         
                    </select>
                    @if ($errors->has('category_id'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
                  </div>
    
              </div>

              <div class="row">
                <div class="input-field col s12 m6">
                    <select name="position" style="display: block" required>
                        <option value="" disabled selected>Job Type</option>
                       
                           <option value="Full Time">Full Time</option>
                           <option value="Part Time">Part Time</option>
                           <option value="Freelance">Freelance</option>
                           <option value="Intern">Intern</option>
                           <option value="Volunteer">Volunteer</option>
                     
                         
                    </select>
                    @if ($errors->has('category'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('category') }}</strong>
                    </span>
                @endif
                  </div>

                  <div class="input-field col s12 m6">
                    <input name="deadline" id="disabled3xb" value="{{old('deadline')}}" type="date" class="validate" required>
                    <label for="disabled3xb">Deadline</label>
                    @if ($errors->has('deadline'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('deadline') }}</strong>
                    </span>
                @endif
                  </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                    <textarea name="details" id="textarea1" class="materialize-textarea" required>{{old('details')}}</textarea>
                      <label for="textarea1">Job Description</label>

                      @if ($errors->has('details'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('details') }}</strong>
                      </span>
                  @endif
                    </div>
              </div>
         
            <button href="#" class="btn indigo accent-1">save</button>
          </form>
        </div>
      </div>
    </section>
@endsection