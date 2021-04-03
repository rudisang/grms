<div>
    

    <!-- Modal Structure -->
    <div id="categoryadd" class="modal">
        <form action="/jobs/category/add" method="post">
            @csrf
      <div class="modal-content">
        <div class="input-field col s12 m12">
            <input name="name" id="disabled" value="{{old('name')}}" type="text" class="validate" required>
            <label for="disabled">Add Category</label>
                      @if ($errors->has('name'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn indigo accent-1">Save</button>
      </div>
    </form>
    </div>

    <div class="card-panel">
      <h4>Job Categories</h4>
      <a class="indigo accent-1 waves-effect waves-light btn modal-trigger" href="#categoryadd">add</a>
        <table>
            <thead>
              <tr>
                  <th>#</th>
                  <th>Category</th>
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
                @foreach($categories as $category)
       
                  <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td><a class="amber waves-effect waves-light btn modal-trigger" href="#{{$category->name}}">edit</a></td>
                  </tr>

                  <div id="{{$category->name}}" class="modal">
                    <form action="/jobs/category/edit/{{$category->id}}" method="post">
                        {{ method_field('PATCH') }}
                        @csrf
                  <div class="modal-content">
                    <div class="input-field col s12 m12">
                        <input name="name" id="disabled" value="{{$category->name}}" type="text" class="validate" required>
                        <label for="disabled">edit Category</label>
                                  @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong style="color:red">{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
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
          {{$categories->links('/vendor/pagination/default')}}
          
    </div>
</div>