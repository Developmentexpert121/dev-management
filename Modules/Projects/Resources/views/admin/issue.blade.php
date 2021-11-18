@include('projects::admin.header')


<div class="container">
 <section class="" style="background-color: #eee;" >
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">Create Issue</h4>

              <form class=" align-items-center" action='{{url("projects/team/create_issue")}}' method='post' enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type='hidden' name='project_id' value='{{$project_id}}'/>
                <div class="row">
                  <div class="col-4">

                    <div class="form-outline">
                      <label>Project</label>
                      <select id="form1" name="project" class="form-control" readonly >
                        <option value="{{$project_id}}" selected>{{$project_data['name']}}</option>
                      </select>
                      @if($errors->has('project'))
                      <div class="error">{{$errors->first('project') }}</div>
                      @endif
                    </div>

                  </div>

                  <div class="col-4">

                    <div class="form-outline"> 
                      <label>Issue Type</label>  
                        <select name="issue_type" class="form-control"> 

                          <option value="">Please Select Issue Type</option> 
                          @foreach($types as $type) 
                            <option value="{{$type->id}}">{{$type->issue_type}}</option>
                          @endforeach
                       </select>
                       @if($errors->has('issue_type'))
                         <div class="error">{{ $errors->first('issue_type') }}</div>
                         @endif  
                    </div>
                    
                  </div>

                  <div class="col-4">

                    <div class="form-outline">
                      <label>Summary</label>
                      <input type="text" id="summary" name="summary" class="form-control" placeholder="Enter a task here" />
                      @if($errors->has('summary'))
                      <div class="error">{{ $errors->first('summary') }}</div>
                      @endif
                    </div>

                  </div>



                 <div class="col-6">
                    <div class="form-outline">
                      <label>Assignee</label><br>
                      <select name="assignee" id="assignee" class="form-control">

                      <option value="">Please Select Team Leader</option>
                      @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                      </select>
                    </div>
                </div>


              <div class="col-4">
              <div class="form-outline">

                      <label>Priority</label><br> 

                      <select name="priority" id="priority" class="form-control">
                         @if($errors->has('priority'))
                      <div class="error">{{ $errors->first('priority') }}</div>
                      @endif
                        <option value="Highest">Highest</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                        <option value="Lowest">Lowest</option>
                      </select>

                </div>
                </div> 

  

               <div class="col-6">

                    <label>Sprint</label>
                    <select name="sprint" class="form-control">
                    <option value="">Please Select Sprint</option>
                       @if($errors->has('sprint'))
                      <div class="error">{{ $errors->first('sprint') }}</div>
                      @endif
                      @foreach($sprints as $sprint)
                        @if($sprint->id)
                        <option value="{{$sprint->id}}">{{$sprint->sprint_name}}</option>
                        @endif

                      @endforeach
                    </select>

                </div>    


                </div>
                <br> 
         
                <div class="col-12">

                  <div class="form-outline">
                    <label>Description</label>
                    <textarea  id="description" name="description" class="form-control" placeholder="Enter Issue Description"></textarea>
                  </div>

                </div>

                <div class="row">

                  <div class="col-2">
                    <button type="submit" class="btn btn-primary">Create Issue</button>
                  </div>

                </div>  

              </form> 

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
   


<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor.create( document.querySelector( '#description' ) )
  .then( editor => {
        console.log( editor );
  } )
  .catch( error => {
        console.error( error );
  } );
</script>


@include('projects::admin.footer')