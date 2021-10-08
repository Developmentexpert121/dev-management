@include('projects::admin.header')

<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">To Do List</h4>
              <form class=" align-items-center" action='{{url("projects/team/project/add_task")}}' method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type='hidden' name='project_id' value='{{$project_id}}'/>

                <div class="row">
                  <div class="col-6">
                    <div class="form-outline">
                      <input type="text" id="form1" name="new_task" class="form-control" placeholder="Enter a task here" />
                    </div>
                  </div>
                  <div class="col-6">
                    <select name="sprint" class="form-control">
                      @foreach($sprints as $sprint)
                        <option value="{{$sprint->id}}">{{$sprint->sprint_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <br>
      
                <div class="row">
                  <div class="col-6">
                    <select name="sprint" class="form-control">
                      @foreach($types as $type)
                        <option value="{{$sprint->id}}">{{$type->issue_type}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <br>

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
<style type="text/css">
  .custom_div { padding-top: 7rem !important; }
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
</style>
@include('projects::admin.footer')