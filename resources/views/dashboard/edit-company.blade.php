@extends('layouts.main')

@section('content')
<nav class="white">
    <div class="container">
        <div class="nav-wrapper">
            <a href="/dashboard" class="breadcrumb indigo-text">{{Auth::user()->role->role}} Dashboard</a> 
            <a href="/dashboard" class="breadcrumb indigo-text">Manage Company</a>
            <a class="breadcrumb grey-text">{{$company->name}}</a>
        </div>
    </div>
</nav>
    <section class="container">
        <x-flash-messages />
    </section>

    <section class="container" style="margin-top:10px">
        <div class="card-panel">
       
            <h4>Company Account Edit</h4>
        
          <form action="/dashboard/edit-company/{{$company->id}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="row">
                <div class="input-field file-field col s12 m6">
                    <div class="btn indigo accent-1">
                        <span><i class="material-icons">cloud_upload</i></span>
                        <input name="logo" type="file">
                      </div>
                      <div class="file-path-wrapper">
                        <input name="logo"  class="file-path validate" type="text" accept="image/*">
                        <label for="">Logo</label>
                      </div>
                  @if ($errors->has('logo'))
                  <span class="help-block">
                      <strong style="color:red">{{ $errors->first('logo') }}</strong>
                  </span>
              @endif
                </div>

         

              </div>
  
    
              <div class="row">
                <div class="input-field col s12 m6">
                  <input name="name" id="disabled" value="{{$company->name}}" type="text" class="validate">
                  <label for="disabled">Company Name</label>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                </div>

                
                    <div class="input-field col s12 m6">
                      <input name="email" id="disabled2" value="{{$company->email}}" type="email" class="validate">
                      <label for="disabled2">Company Email</label>
                      @if ($errors->has('email'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                    </div>
    
                    <div class="input-field col s12 m6">
                        <input name="physical_address" id="disabled3" value="{{$company->physical_address}}" type="text" class="validate">
                        <label for="disabled3">Physical Address</label>
                        @if ($errors->has('physical_address'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('physical_address') }}</strong>
                        </span>
                    @endif
                      </div>

                   
                      <div class="input-field col s12 m6">
                        <input name="postal_address" id="disabled3x" value="{{$company->postal_address}}" type="text" class="validate">
                        <label for="disabled3x">Postal Address</label>
                        @if ($errors->has('postal_address'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('postal_address') }}</strong>
                        </span>
                    @endif
                      </div>

                      <div class="input-field col s12 m6">
                        <input name="phone" id="disabled3xb" value="{{$company->phone}}" min=308111 type="number" class="validate">
                        <label for="disabled3xb">Phone</label>
                        @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                      </div>

                      <div class="input-field col s12 m6">
                      <textarea name="bio" id="textarea1" class="materialize-textarea">{{$company->bio}}</textarea>
                        <label for="textarea1">Bio</label>

                        @if ($errors->has('bio'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('bio') }}</strong>
                        </span>
                    @endif
                      </div>

    
              </div>
         
            <button href="#" class="btn indigo accent-1">Update Account</button>
          </form>
        </div>
      </div>
    </section>
@endsection