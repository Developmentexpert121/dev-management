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
  <div class="main-panel">  
  <a href='{{url("admin/project/team/createissue/{$project_id}")}}'><button type="button" class="create_button"> Create Task</a> </button> 
<button type="button" class="create_button" id="sprint_button"> Create Sprint</button></a>
        <div id="all_sprints" class="all_sprints" style="display: none;">
  
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>  
    @endif
 
  <form method="post" action="{{ url('admin/project/team/save_sprint') }}"> 
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
   Sprint Name  <input type="text" name="sprint_name" value=""><br><br>
   Duration:<select name="duration" >
    <option value="1">1week</option>
    <option value="2">2week</option>
    <option value="3">3week</option>
    <option value="4">Custom</option>
   </select><br><br>
   Start date:<input type="date" name="start_date"><br><br>
   End date:<input type="date" name="end_date" ><br><br>
   Sprint goal:
   <textarea name="sprint_goal" rows="4" cols="50"></textarea>
  <br><br>
   <input type="submit" name="" value="Start Sprint">

   </form>
   </div>  


    <div class="row"> 
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash"></h4>
                                   <h5 class="card-subtitle card-subtitle-dash"></h5>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                                <div class="chartjs-wrapper mt-5">
                                  <!-- <canvas id="performaneLine"></canvas> -->
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card bg-primary card-rounded">
                              <div class="card-body pb-0">
                                <h4 class="card-title card-title-dash text-white mb-4"></h4>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <p class="status-summary-ight-white mb-1"></p>
                                    <h2 class="text-info"></h2>
                                  </div>
                                  <div class="col-sm-8">
                                    <div class="status-summary-chart-wrapper pb-4">
                                      <canvas id="status-summary"></canvas>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>    
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                      <!-- <div class="circle-progress-width">
                                        <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                      </div> -->
                                      <div>
                                        <p class="text-small mb-2"></p>
                                        <h4 class="mb-0 fw-bold"></h4>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                     <!--  <div class="circle-progress-width">
                                        <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                                      </div> -->
                                      <div>
                                        <p class="text-small mb-2"></p>
                                        <h4 class="mb-0 fw-bold"></h4>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    

    @include('projects::team.footer') 

<style type="text/css">
	button.create_button {
    width: 12%;
}
.all_sprints {
    display: none !important;
}
.blue {
	display: block !important;
}

</style>


<script>
$(document).ready(function(){
  $("#sprint_button").click(function(){
    $("#all_sprints").toggleClass("blue");
  });
});

function nextweek(){
    var today = new Date();
    var nextweek = new Date(today.getFullYear(), today.getMonth(), today.getDate()+7);
    return nextweek;
}
</script>







>>>>>>> 78b4940f56b5dd1616af9de10c3db15b80024d19
