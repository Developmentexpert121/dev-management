@include('user::tl.header')

<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">Sprints</h4>
              <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
          <tr>
              <th>Project Name</th>
                <th>Sprint Name</th>
                <th>Issue Name</th>
                <th>Assign To</th>     
       <tbody>
           <?php 
           foreach($tldata as $data) { ?>
       <tr> 
                    
                    <td>{{$data->project_name}}</td>  
                    <td>{{$data->sprint_name}}</td>  
                    <td>{{$data->issue_name}}</td>
                    <td> 
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$data->id}}">
                        Assign To Employee
                            </button>
                    </td> 

                    <!-- Modal -->
                <div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">Assign To Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        

                <form class=" align-items-center" action='{{url("team_leader/create_issue")}}' method='post' enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="edit_id" value="{{$data->id}}">
        
                <div class="row">
                  <div class="col-6">

                    <div class="form-outline">
                      <label>Project</label>
                      <input type="text" id="project" name="project" class="form-control" placeholder="Enter a task here" value="{{$data->project_name}}" readonly/>
                    </div>

                  </div>

                  <div class="col-6">

                    <div class="form-outline">
                      <label>Summary</label>
                      <input type="text" id="summary" name="summary" class="form-control" placeholder="Enter a task here" value="{{$data->issue_name}}" readonly/>
                      @if($errors->has('summary'))
                      <div class="error">{{ $errors->first('summary') }}</div>
                      @endif
                    </div>

                  </div>

                 <div class="col-6">
                    <div class="form-outline">
                      <label>Assignee</label><br>
                      <select name="assignee" id="assignee" class="form-control" value="">

                      <option value="">Please Select Employee</option>
                      @foreach($users as $user)
                      <option  <?php echo ($data->assign_to_employe) == $user->id ? 'selected' : '' ?> value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                      </select>
                    </div>
                </div>


              <div class="col-6">
              <div class="form-outline">

                      <label>Priority</label><br> 

                      <input type="text" name="priority" id="priority" class="form-control" value="{{$data->priority}}" readonly>
                         @if($errors->has('priority'))
                      <div class="error">{{ $errors->first('priority') }}</div>
                      @endif


                </div>
                </div> 


                </div>
                <br> 
         
                <div class="col-12">

                  <div class="form-outline">
                    <label>Description</label>
                    <textarea  id="description" name="description" class="form-control" placeholder="Enter Issue Description" value="{{$data->description}}" readonly>{{$data->description}}</textarea>
                  </div>

                </div>

                <div class="row">

                  <div class="col-2 issuebutton">
                    <button type="submit" class="btn btn-primary">Assignee</button>
                  </div>

                </div> 

              </form> 

                      </div>
                      
                    </div>
                  </div>
                </div>


        <?php } ?>
            </tr>
             </tbody>
        </tr>
        </thead>
        <tfoot>
            <tr>
               <th>Project Name</th>
                <th>Sprint Name</th>
                <th>Issue Name</th>
                <th>Assign To</th>
            </tr>
        </tfoot>
                    

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('user::tl.footer')
 <div class="row" style="width: 100%;">

  @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<style>
    .col-2.issuebutton {
    margin: 15px 0px 0px 14px;
    }
    </style>




          