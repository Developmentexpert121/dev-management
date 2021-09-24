@include('projects::team.header')
<div class="main-panel">    
 <a href='<?php echo url("admin/project/team/backlog/sprints/form/$project_id") ?>'><button type="button" class="create_button"> Create Sprint</button> </a> 

        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
              
                @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif 
     <table id="example" class="table table-striped table-bordered" style="width:100%">
     <thead>
        <tr>
            <th>Sr.No</th>
            <th>Sprint Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Created By</th>
            <th>Issue Create</th>
            <th>view</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $i=1;
      ?>
    @foreach($sprint as $sprint_val)
        <tr> 
            <td>{{$i++}}</td> 
            <td>{{$sprint_val->sprint_name }}</td>
            <td>{{$sprint_val->start_date }}</td>
            <td>{{$sprint_val->end_date }}</td> 
            <td>Admin</td>
            <td><a href='{{url("admin/project/team/createissue/{$project_id}")}}'><button type="button" class="create_button"> Create Task</button> </a> </td>
            <td><a href='{{url("admin/project/team/sprint/detail/{$project_id}/{$sprint_val->id}")}}'> view</a></td>
        </tr>
  @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Sr.No</th>
             <th>Name</th>
             <th>key</th>
             <th>Created by</th>
             <th>Template</th>
             <th>Project Type</th>
         </tr>
    </tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
    @include('projects::team.footer')