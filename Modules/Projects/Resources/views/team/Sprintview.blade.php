@include('projects::team.header')
<<<<<<< HEAD
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sprint Form</h4>
                  <p class="card-description">
                    Create Sprint
                  </p> 
=======
  <div class="main-panel">  
 <!--  <a href='{{url("admin/project/team/createissue/{$project_id}")}}'><button type="button" class="create_button"> Create Task</a> </button> 
<button type="button" class="create_button" id="sprint_button"> Create Sprint</button></a> -->
        <div id="all_sprints" class="all_sprints" >
>>>>>>> 78b4940f56b5dd1616af9de10c3db15b80024d19
  
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>  
    @endif
 
<<<<<<< HEAD
        <form method="post" action="{{ url('admin/project/team/save_sprint') }}"> 

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <input type="hidden" name="project_id" value="{{$project_id}}">
        Sprint Name <input type="text" name="sprint_name" value=""><br><br>
        Duration:<select name="duration" >
           <option value="">Please Select Duration</option>
           <option value="1">1week</option>
           <option value="2">2week</option>
           <option value="3">3week</option>
           <option value="4">Custom</option>
      </select>
      <br><br>

       Start date:<input type="date" name="start_date">
       <br><br>

       End date:<input type="date" name="end_date" >
       <br><br>

       Sprint goal:
      <textarea name="sprint_goal" rows="4" cols="50"></textarea>
      <br><br>

      <input type="submit" name="" value="Start Sprint">

   </form>
   </div>  
   </div> 
   </div> 
   </div> 
   </div> 

    
                    
=======
  <form method="post" action="{{ url('admin/project/team/save_sprint') }}"> 

    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <input type="hidden" name="project_id" value="{{$project_id}}">
   Sprint Name <input type="text" name="sprint_name" value=""><br><br>
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
                    

>>>>>>> 78b4940f56b5dd1616af9de10c3db15b80024d19
    @include('projects::team.footer') 











