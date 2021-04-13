@extends('layouts.main')

@section('content')
<nav class="white z-depth-0" style="border-top: 1px solid rgb(223, 223, 223)">
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
                <div class="card-panel" style="border-radius:20px">
                  <h5>My Profile</h5>
                  
                  <a class="waves-effect waves-light btn modal-trigger indigo accent-1" href="#modal1">Add Attachments</a> @if(Auth::user()->attachments->count() < 1)or <a class="waves-effect waves-light btn indigo accent-1" href="/profile/create">Create Your Graduate Profile</a>@endif
                  
                </div>
              </div>
            </div>

            @if(Auth::user()->attachments->count() > 0)
            <div class="row">
              <div class="col s12">
                <div class="card-panel" style="border-radius:20px">
                  <h5>My Attachments</h5>
                  <div class="row">
                    @foreach (Auth::user()->attachments as $att)
                    <div class="input-field file-field col s12 m3">
                      <h5 for="">{{$att->title}}</h5>
                      <a href="{{asset('documents/'.$att->attachment)}}" class="btn indigo accent-1" download>
                          <span><i class="material-icons">cloud_download</i></span>
                          
                        </a>
                        
                        <div class="file-path-wrapper">
                              
                          <a class="white-text btn indigo accent-1 modal-trigger" href="#view{{$att->id}}"><span><i class="material-icons">remove_red_eye</i></span></a>
                          <a style="margin-left:10px" class="white-text btn indigo accent-2 modal-trigger" href="#edit{{$att->id}}"><span><i class="material-icons">edit</i></span></a>
                      
                    </div>
                   
  
                    <!-- Modal Structure -->
                    <div id="view{{$att->id}}" class="modal">
                      <div class="modal-content">
                          <embed src="{{asset('documents/'.$att->attachment)}}" width="800px"/>
                        
                      </div>
                      
                    </div>
                  </div>

                  <div id="edit{{$att->id}}" class="modal">
                    <div class="modal-content">
                      <h4>Edit Attachment</h4>
                      <form action="/attachment/edit/{{$att->id}}" method="post" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                      @csrf
      <div class="row">
                      <div class="input-field col s12 m6">
                        <select name="title" style="display: block">
                          <option value="" selected disabled>Select Attachment Type</option>
                          <?php $arr = ['CV','Certificate','ID Document','Transcript','Letter']; ?>
                          @foreach($arr as $item)
                          
                             <option value="{{ $item }}" @if($att->title === $item) selected='selected' @endif> {{ $item }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('title'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                      </div>
      
                      <div class="input-field file-field col s12 m6">
                        <div class="btn indigo accent-1">
                            <span><i class="material-icons">cloud_upload</i></span>
                            <input name="attachment" type="file">
                          </div>
                          <div class="file-path-wrapper">
                            <input name="attachment"  class="file-path validate" type="text" accept="image/*">
                            <label for="">Change Attachment</label>
                          </div>
                      @if ($errors->has('attachment'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('attachment') }}</strong>
                      </span>
                  @endif
                    </div>
      </div>
                      
                    </div>
                    <div class="modal-footer">
                      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                      <button type="submit" class="waves-effect waves-green btn indigo accent-1">Save</button>
                    </div>
                  </form>
                  </div>
                    @endforeach
                  </div>
                  
                </div>
              </div>
            </div>
            @endif



            <div id="modal1" class="modal">
              <div class="modal-content">
                <h4>Add Attachment</h4>
                <form action="/attachment/create" method="post" enctype="multipart/form-data">
                @csrf
<div class="row">
                <div class="input-field col s12 m6">
                  <select name="title" style="display: block">
                    <option value="" selected disabled>Select Attachment Type</option>
                    <?php $arr = ['CV','Certificate','ID Document','Transcript','Letter']; ?>
                    @foreach($arr as $item)
                    
                       <option value="{{ $item }}" @if(old('title') === $item) selected='selected' @endif> {{ $item }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('title'))
                  <span class="help-block">
                      <strong style="color:red">{{ $errors->first('title') }}</strong>
                  </span>
              @endif
                </div>

                <div class="input-field file-field col s12 m6">
                  <div class="btn indigo accent-1">
                      <span><i class="material-icons">cloud_upload</i></span>
                      <input name="attachment" type="file">
                    </div>
                    <div class="file-path-wrapper">
                      <input name="attachment"  class="file-path validate" type="text" accept="image/*">
                      <label for="">Attachment</label>
                    </div>
                @if ($errors->has('attachment'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('attachment') }}</strong>
                </span>
            @endif
              </div>
</div>
                
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                <button type="submit" class="waves-effect waves-green btn indigo accent-1">Save</button>
              </div>
            </form>
            </div>

            <div class="row">
                <div class="col s12">
                  <div class="card-panel" style="border-radius:20px">
                    <h5>My Applications</h5>
                    @if (Auth::user()->applications->count() > 0)
                    <table>
                      <thead>
                        <tr>
                            
                            <th>Job Post</th>
                            <th>Date Applied</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                      </thead>
              
                      <tbody>
                        @foreach(Auth::user()->applications as $app)
                           
                        <tr>
                          <td>{{$app->job_post->title}}</td>
                          <td>{{$app->created_at->diffForHumans()}}</td>
                          <td>@if($app->status == 1)
                              <span class="btn green black-text">Received</span>
                              @else
                              <span class="btn amber">Submited</span>
                              @endif
                          </td>
                          <td><a href="" class="btn indigo accent-1">View</a></td>
                         
                        </tr>
                        
      
                      @endforeach
                        
                      </tbody>
                    </table>
                    @endif
                    
                  </div>
                </div>
              </div>
           

        @elseif(Auth::user()->role_id == 2)
        
            @if(Auth::user()->company)
              

              <div class="row">
                <h5>My Job Posts</h5>
                <div class="card-panel" style="padding-left:20px;border-radius:20px">

                  <a href="/dashboard/job-post/create" class="btn indigo accent-1">Create Job Post</a>
                  <br>
                  @if(Auth::user()->company->jobposts->count() > 0)
                    <x-user-job-posts-table />
                  @else
                  <p class="grey-text center">No Job Posts Yet</p>
                  @endif
                 
                </div>
              </div>
            @else
            <div class="card-panel blue lighten-2">
              <div class="white-text" role="alert">
                  🛈 Almost There! Setup Your Recruiter account inorder to get started. 
                </div>
              </div>
              <a href="/dashboard/create-company" class="btn indigo accent-1 pulse">Setup Account</a>
     
            @endif
             

           
            @elseif(Auth::user()->role_id == 3)
            <x-admin-user-table />
            <x-admin-category-table />
   
        @endif
    </section>
    
@endsection