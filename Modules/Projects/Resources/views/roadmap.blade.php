@include('projects::admin.header')



<div class="container">
 <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">To Do List</h4>
              <form class=" align-items-center" action='{{url("projects/team/project/add_task")}}' method='post' enctype="multipart/form-data">
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

                          <option value="">Select</option> 
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

                  <div class="col-4">

                    <div class="form-outline">
                      <label>Attachment</label>
                      <input type="file" id="attachment" name="attachment" class="form-control" placeholder="Enter a task here" />
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-outline">
                      <label>Reporter</label>
                      <select id="reporter" name="reporter" class="form-control" placeholder="Enter a task here">
                        @if($errors->has('reporter'))
                      <div class="error">{{ $errors->first('reporter') }}</div>
                      @endif
                      @foreach($users as $user)
                      <!-- <option value="{{$task}}">{{$task}} </option> -->
                        <option value="{{$user->id}}" <?php if($user->id == Auth::user()->id){ echo 'selected'; } ?>>{{$user->name}}</option>
                     @endforeach
                      </select>
                    </div> 
                  </div>

                  <div class="col-4">
                    <div class="form-outline">
                      <label>Linked Issues</label><br>
                      <select name="linked_issues" id="linked_issues" class="form-control">
                        <option value="blocks">blocks</option>
                        <option value="is_blocked_by">is blocked by </option>
                        <option value="clones">clones</option>
                        <option value="is_cloned_by">is cloned by</option>
                        <option value="duplicates">Duplicates</option>
                        <option value="is_duplicated_by">is duplicated by</option>
                        <option value="causes">causes</option>
                        <option value="is_causes_by">is causes by</option>
                        <option value="relates_to">relates to</option>
                      </select>
                    </div>
                  </div>

                 <div class="col-6">
                    <div class="form-outline">
                      <label>Assignee</label><br>
                      <select name="assignee" id="assignee" class="form-control">
                      @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-6">

                    <div class="form-outline">
                      <label>Issue</label><br>
                      <select name="issue" id="issue" class="form-control">
                        <option value="select">select</option>
                      </select>
                      <p>Begin typing to search for issues to link. If you leave it blank, no link will be made.</p>
                    </div>

                  </div>

            <div class="col-4">

                    <div class="form-outline">
                      <label>Fix versions</label><br>
                      <b>None</b>
                    </div>
                      
            </div>

              <div class="col-4">
              <div class="form-outline">

                      <label>Priority</label><br>

                      <select name="priority" id="priority" class="form-control">
                         @if($errors->has('priority'))
                      <div class="error">{{ $errors->first('priority') }}</div>
                      @endif
                        <option value="highest">1.Highest</option>
                        <option value="high">2.High</option>
                        <option value="causes">3.Medium</option>
                        <option value="is_causes_by">4.Low</option>
                        <option value="relates_to">5.Lowest</option>
                      </select>

                </div>
                </div>

                  <div class="col-4">

                    <div class="form-outline">
                      <label>Labels</label><br>
                      <select name="labels" id="labels" class="form-control">
                        <option value="select">user</option>
                      </select>
                       <p>Begin typing to find and create labels or press down to select a suggested label.</p>
                    </div>

                  </div>

                 <div class="col-6">
                    <div class="form-outline">
                      <label>Epic Link</label><br>
                      <select name="epic_link" id="epic_link" class="form-control">
                        <option value="select">select</option>
                      </select>
                    </div>
                    <p>Choose an epic to assign this issue to.</p>
                  </div>
  

               <div class="col-6">

                    <label>Sprint</label>
                    <select name="sprint" class="form-control">
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
                    <textarea  id="description" name="description" class="form-control" placeholder="Enter a task here"></textarea>
                  </div>

                </div>

                <div class="row">

                  <div class="col-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>

                </div>

                <!-- <div class="col-2">
                  <button type="submit" class="btn btn-warning">Get tasks</button>
                </div> -->
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="row" style="width: 100%;">
    <?php if(!empty($tasks)){ ?>
      <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
          <tr>
              <th>Sr.No</th>
                <th>Task</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
              $i=1;
              foreach($tasks as $data){
                ?>
                <tr>
                    <td><?php echo $i++  ?></td>
                    <td><?php echo ucfirst($data->task_type);  ?></td>
                    <td><?php echo ucfirst($data->sprint_name) ; ?></td>
                    <td>
                      <select>
                        <option value="to-do">To Do</option>
                        <option value="in-progress">In Progress</option>
                        <option value="done">Done</option>
                      </select>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>   
            <tr>
                <th>Sr.No</th>
                <th>Task</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
        </tfoot>
      </table>
    <?php } ?>
  </div>
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
<style type="text/css">
  .form-outline { margin: 7px; }
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
  .form-control:disabled, .asColorPicker-input:disabled, .dataTables_wrapper select:disabled, .select2-container--default .select2-selection--single:disabled, .select2-container--default .select2-selection--single .select2-search__field:disabled, .typeahead:disabled, .tt-query:disabled, .tt-hint:disabled, .form-control:read-only, .asColorPicker-input:read-only, .dataTables_wrapper select:read-only, .select2-container--default .select2-selection--single:read-only, .select2-container--default .select2-selection--single .select2-search__field:read-only, .typeahead:read-only, .tt-query:read-only, .tt-hint:read-only {
    background-color: #fff !important;
    opacity: 1; }
    input#attachment {
    height: 37px;
}
</style>
@include('projects::admin.footer')