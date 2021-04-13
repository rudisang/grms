<div>
    <table>
        <thead>
          <tr>
              <th>Job Title</th>
              <th>Deadline</th>
              <th>Action</th>
              <th><form method="GET" action="/dashboard">
                    <div class="input-field col s6">
                        <input id="searchcat" name="cat" type="search" class="validate">
                        <label for="searchcat">Search</label>
                      </div>
                  </form>
                </th>
          </tr>
        </thead>

        <tbody>
            @php $posts = Auth::user()->company->jobposts->sortBy('deadline'); @endphp
            @foreach($posts as $job)
   
              <tr>
                <td>{{$job->title}}</td>
                <td>{{$job->deadline}}</td>
                <td><a class="amber waves-effect waves-light btn modal-trigger" href="#{{$job->id}}">edit</a> </td>
                <td><a class="indigo accent-1 waves-effect waves-light btn modal-trigger" href="/applications/{{$job->id}}">applications({{$job->applications->count()}})</a></td>
              </tr>

              <div id="{{$job->id}}" class="modal white" >
                <form action="/dashboard/job-post/edit/{{$job->id}}" method="post">
                    {{ method_field('PATCH') }}
                    @csrf

                    <div class="modal-content white" style="min-height:50vh">
                        <div class="row">
                            <div class="input-field col s12 m6">
                              <input name="title" id="disabled" value="{{$job->title}}" type="text" class="validate" required>
                              <label for="disabled">Job Title</label>
                                        @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong style="color:red">{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                            </div>
            
                            
                            <div class="input-field col s12 m6">
                                <select name="category_id" style="display: block" required>
                                    <option value="" disabled>Select Category</option>
                                    @foreach($categories as $item)
                                       <option value="{{ $item->id}}" @if($item->id == $job->category_id) selected @endif> {{ $item->name }}</option>
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
                                    <option value="" disabled >Job Type</option>
                                   @php $arr = ["Full Time","Part Time","Freelance","Intern","Volunteer"] @endphp

                                   @foreach ($arr as $item)
                                       <option value="{{$item}}" @if($item == $job->position) selected @endif>{{$item}}</option>
                                   @endforeach
                               
                                 
                                     
                                </select>
                                @if ($errors->has('position'))
                                <span class="help-block">
                                    <strong style="color:red">{{ $errors->first('position') }}</strong>
                                </span>
                            @endif
                              </div>
            
                              <div class="input-field col s12 m6">
                                <input name="deadline" id="disabled3xb" value="{{$job->deadline}}" type="date" class="validate" required>
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
                                <textarea name="details" id="textarea1" class="materialize-textarea" required>{{$job->details}}</textarea>
                                  <label for="textarea1">Job Description</label>
            
                                  @if ($errors->has('details'))
                                  <span class="help-block">
                                      <strong style="color:red">{{ $errors->first('details') }}</strong>
                                  </span>
                              @endif
                                </div>
                          </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn indigo accent-1">Save</button>
                    </div>

                </form>
            </div>
             

            @endforeach
            
        </tbody>
      </table>
  
 
</div>