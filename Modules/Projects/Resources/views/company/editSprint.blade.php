@include('projects::company.header') 

<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-left">Sprints </h4> 
                
              <form class="row align-items-center" action="<?php echo url('projects/company/sprints/edit/'.$allSprint_dit_val['id']) ?>" method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden"  value="<?php echo $project_id ?>" name="project_id">
   
                 <div class="row">
                    <div class="col-6">
                      <div class="form-outline">
                        <label>Name</label>
     
                        <input type="text" id="form1" name="new_sprint" class="form-control" placeholder="Enter a sprint here" value="<?php echo $allSprint_dit_val['sprint_name'] ?>"/>
                      </div>
                      
                      @if($errors->has('new_sprint'))
                      <div class="error">{{ $errors->first('new_sprint') }}</div>
                      @endif
                      <br>
                   
                     
                    </div>
                    <div class="col-6">
                      <div class="form-outline">
                        <label>Start Date</label>
                        <input type="date" id="form1" value="<?php echo $allSprint_dit_val['start_date'] ?>" name="start_date" class="form-control startDate"/>
                      </div>
                      @if($errors->has('start_date'))
                      <div class="error ">{{ $errors->first('start_date') }}</div>
                      @endif
                      <br>
                    </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-outline">
                      <label>Duration</label>
                      <select name="duration" class="form-control">
                        <option value="">Select</option>
                        <option value="1" <?php if($allSprint_dit_val['duration'] == '1'){ echo 'selected'; } ?>>1 week</option>
                        <option value="2" <?php if($allSprint_dit_val['duration'] == '2'){ echo 'selected'; } ?>>2 week</option>
                        <option value="3" <?php if($allSprint_dit_val['duration'] == '3'){ echo 'selected'; } ?>>3 week</option>
                        <!-- <option value="4">Custom</option> -->
                      </select>
                    </div>
                    @if($errors->has('duration'))
                      <div class="error">{{ $errors->first('duration') }}</div>
                      @endif
                    <br>
                  </div>
                  <div class="col-6">
                      <div class="form-outline">
                        <label>End Date</label>
                        <input type="date" id="form1" value="<?php echo $allSprint_dit_val['end_date'] ?>"  name="end_date" class="form-control endDate"/>
                      </div>
                      @if($errors->has('end_date'))
                      <div class="error">{{ $errors->first('end_date') }}</div>
                      @endif
                      <br>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-outline">
                      <textarea class="form-control"  name="sprint_goal" rows="4" cols="50" placeholder="Sprint Goal"><?php echo $allSprint_dit_val['sprint_goal'] ?></textarea>
                    </div>
                    @if($errors->has('sprint_goal'))
                      <div class="error">{{ $errors->first('sprint_goal') }}</div>
                      @endif
                    <br>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary">Edit</button>
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

</div>
<style type="text/css">
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
</style>
@include('projects::company.footer')
<script type="text/javascript">
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();
  if(month < 10){
    month = '0' + month.toString();
  }
  if(day < 10){
    day = '0' + day.toString();
  }
  var maxDate = year + '-' + month + '-' + day;
  $('.startDate').attr('min', maxDate);
  $('.endDate').attr('min', max{{url("projects/team/project/add_sprint")}}