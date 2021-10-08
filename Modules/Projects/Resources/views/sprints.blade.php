@include('projects::admin.header')
<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">Sprints</h4>
             
              <form class="row align-items-center" action='{{url("projects/team/project/add_sprint")}}' method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type='hidden' name='project_id' value='{{$project_id}}'/>
                 <div class="row">
                    <div class="col-6">
                      <div class="form-outline">
                        <label>Name</label>
                        <input type="text" id="form1" name="new_sprint" class="form-control" placeholder="Enter a sprint here" value="{{old('new_sprint')}}"/>
                      </div>
                      
                      @if($errors->has('new_sprint'))
                      <div class="error">{{ $errors->first('new_sprint') }}</div>
                      @endif
                      <br>
                   
                     
                    </div>
                    <div class="col-6">
                      <div class="form-outline">
                        <label>Start Date</label>
                        <input type="date" id="form1" value="{{old('start_date')}}" name="start_date" class="form-control startDate"/>
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
                        <option value="1" <?php if(old('duration') == '1'){ echo 'selected'; } ?>>1 week</option>
                        <option value="2" <?php if(old('duration') == '2'){ echo 'selected'; } ?>>2 week</option>
                        <option value="3" <?php if(old('duration') == '3'){ echo 'selected'; } ?>>3 week</option>
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
                        <input type="date" id="form1" value="{{old('end_date')}}"  name="end_date" class="form-control endDate"/>
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
                      <textarea class="form-control"  name="sprint_goal" rows="4" cols="50" placeholder="Sprint Goal">{{old('sprint_goal')}}</textarea>
                    </div>
                    @if($errors->has('sprint_goal'))
                      <div class="error">{{ $errors->first('sprint_goal') }}</div>
                      @endif
                    <br>
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

  @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

    <?php if(!empty($sprints)){ ?>
      <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
          <tr>
              <th>Sr.No</th>
                <th>Name</th>
                <th>Goal</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
              $i=1;
              foreach($sprints as $data){
                ?>
                <tr> 
                    <td>{{$i++}}</td>
                    <td>{{$data->sprint_name}}</td>
                    <td>{{$data->sprint_goal}}</td>
                    <td>{{date('d-m-Y', strtotime($data->start_date))}}</td>
                    <td>{{date('d-m-Y', strtotime($data->end_date))}}</td>
                    <td> 
                    <a href="<?php echo url('admin/project/edit_sprint/'.$project_id.'/'.$data->id) ?>"><i class="fa fa-pencil" title="Edit"></i></a>
                    <a href="<?php echo url('admin/project/team/delete_sprint/'.$project_id.'/'.$data->id) ?>" onclick="return confirm('Are you sure you want delete?')"><i class="fa fa-trash-o fa-lg"></i></a>

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
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </tfoot>
      </table>
    <?php } ?>
  </div>
</div>
<style type="text/css">
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
</style>
@include('projects::admin.footer')
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