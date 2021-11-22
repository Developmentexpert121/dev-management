@include('projects::employee.header')

<div class="container">
  <section class="" style="background-color: #eee;">
    <!-- <div class="custom_div">
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
                        <input type="date" id="start_date" value="{{old('start_date')}}" name="start_date" class="form-control startDate"/>
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
                      <select name="duration" id="duration" class="form-control">
                        <option value="">Select</option>
                        <option value="1" <?php if(old('duration') == '1'){ echo 'selected'; } ?>>1 week</option>
                        <option value="2" <?php if(old('duration') == '2'){ echo 'selected'; } ?>>2 week</option>
                        <option value="3" <?php if(old('duration') == '3'){ echo 'selected'; } ?>>3 week</option>
                      
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
                        <input type="date" id="end_date" value="{{old('end_date')}}"  name="end_date" class="form-control endDate"/>
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
                    <button type="submit" class="btn btn-primary">Create Sprint </button>
                  </div>
                </div>

    

              </form>
                    

            </div>
          </div>
        </div>
      </div>
    </div> -->
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
                <th>Create Issue</th>
                <th>Created By</th>
                <!-- <th>Start Sprint</th> -->
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php

              $i=1;
              $j=1;
              foreach($sprints as $key => $data)
              {
                ?>

                <tr> 
                    <td>{{$i++}}</td>
                    <td>{{$data->sprint_name}}</td>  
                    <td>{{$data->sprint_goal}}</td>  
                    <td>{{date('d-m-Y', strtotime($data->start_date))}}</td> 
                    <td>{{date('d-m-Y', strtotime($data->end_date))}}</td> 

                    <td>
                      <a href="<?php echo url('employee/project/sprint/create_issue/'.$project_id.'/'.$data->id) ?>">Create Issue</a>
                    </td>
                    <td>{{ucfirst($data->create_project_user)}}  ({{$data->role}})</td>

                    <!-- <td> 
                       
                    <a href="<?php echo url('employee/project/edit_sprint/'.$project_id.'/'.$data->id) ?>"><i class="fa fa-pencil" title="Edit"></i></a>
                    <a href="<?php echo url('employee/project/team/delete_sprint/'.$project_id.'/'.$data->id) ?>" onclick="return confirm('Are you sure you want delete?')"><i class="fa fa-trash-o fa-lg"></i></a>

                    </td>   -->

                    <td> 
                     <!-- Button trigger modal -->
                     <?php if($last->id==$data->id && $data->sprint_start_status==0){ ?>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$data->id}}">
                      Start Sprint 
                    </button>
                    <?php }
                    else
                    {      

                      if($data->sprint_start_status==1 )
                      {

                        ?> 
                         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#completed_sprint{{$data->id}}">
                          Completed Sprint 
                        </button>   
                        <?php
                        }
                        elseif($data->sprint_start_status==5)
                        { 
                        ?>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$data->id}}">
                          Start Sprint 
                        </button>
                        <?php
                        }
                    
                      
                        elseif($data->sprint_start_status==2)
                        {  
                          ?>
    
                          Completed 
    
                         <?php  
    
                        }

                     //   elseif($data->sprint_start_status==0){ 
                          
                      //   if($j==1){
                         //   echo 'start'.$j;
                        //    $j++; 

                       //  }
                       //  else
                        // {
                       //     echo 'empty'; 
                        // }   
                      
    
                       // }

                        

                    }
                   
                   
                    ?>

                    
                    </td>
                 </tr> 


                    <!-- Modal -->
            <div class="modal fade" id="completed_sprint{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document"> 
                <div class="modal-content"> 
                  <div class="modal-header"> 
                    <h5 class="modal-title" id="completed_sprint">Complete <b>{{$data->sprint_name}}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span> 
                    </button>
                  </div>
                  <div class="modal-body"> 
                              
                  <form class="row align-items-center" action='{{url("admin/projects/team/sprint/complete")}}' method='post'> 
                          
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                        <input type='hidden' name='project_id' value='{{$project_id}}'/> 
                        <input type='hidden' name='sprint_id' value='{{$data->id}}'/>   
                          <?php 
                          
                            if($i-1==$nums)
                            {
                              $next_id = $logs[$key]->id;   
                            }
                            else
                            {
                              $next_id = $logs[$key+1]->id;    
                            }

                          ?>
                          <p>This sprint contains: </p> 
                          
                          <input type="hidden" name="next_id" value="{{$next_id}}"/> 
                              
                            <div class="row">
                              <div class="col-2">
                                <button type="submit" class="btn btn-primary">Complete Sprint</button>
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




            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Start Sprint </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body"> 



                  <form class="row align-items-center" action='{{url("admin/projects/team/sprint/start")}}' method='post' data-parsley-validate="parsley"> 
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type='hidden' name='project_id' value='{{$project_id}}'/>
                            <input type='hidden' name='sprint_id' value='{{$data->id}}'/>  
            
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-outline">
                                    <label>Name</label>
                                    <input type="text" id="form1" name="sprint_name" class="form-control" placeholder="Enter a sprint here" value="{{$data->sprint_name}}" required/>
                                  </div>
                                  
                                  @if($errors->has('sprint_name')) 
                                  <div class="error">{{ $errors->first('sprint_name') }}</div>
                                  @endif


                                  <br>
                                </div>

                                <div class="col-6">
                                  <div class="form-outline">
                                    <label>Start Date</label>
                                    <input type="date" id="form1" value="{{old('start_date')}}" name="sprint_start_date" class="form-control startDate" required/>
                                  </div>
                                  @if($errors->has('sprint_start_date'))
                                  <div class="error ">{{ $errors->first('sprint_start_date') }}</div>
                                  @endif
                                  <br>
                                </div>

                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-outline">
                                  <label>Duration</label>
                                  <select name="sprint_duration" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="1" <?php if(old('sprint_duration') == '1'){ echo 'selected'; } ?>>1 week</option>
                                    <option value="2" <?php if(old('sprint_duration') == '2'){ echo 'selected'; } ?>>2 week</option>
                                    <option value="3" <?php if(old('sprint_duration') == '3'){ echo 'selected'; } ?>>3 week</option>
                                    <!-- <option value="4">Custom</option> -->
                                  </select>
                                </div>
                                @if($errors->has('sprint_duration'))
                                  <div class="error">{{ $errors->first('sprint_duration') }}</div>
                                  @endif
                                <br>
                              </div>
                              <div class="col-6">
                                  <div class="form-outline">
                                    <label>End Date</label>
                                    <input type="date" id="form1" value="{{old('sprint_end_date')}}"  name="sprint_end_date" class="form-control endDate" required="true"/>
                                  </div>
                                  @if($errors->has('sprint_end_date'))
                                  <div class="error">{{ $errors->first('sprint_end_date') }}</div>
                                  @endif
                                  <br>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-12">
                                <div class="form-outline">
                                  <textarea class="form-control"  name="start_sprint_goal" rows="4" cols="50" placeholder="Sprint Goal" required="true">{{$data->sprint_goal}}</textarea>
                                </div> 
                                @if($errors->has('start_sprint_goal'))
                                  <div class="error">{{ $errors->first('start_sprint_goal') }}</div>
                                  @endif
                                <br>
                              </div> 
                            </div> 

                            <div class="row"> 
                              <div class="col-2"> 
                                <button type="submit" class="btn btn-primary">Start Sprint</button>
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



            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
               <th>Sr.No</th>
                <th>Name</th>
                <th>Goal</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Create Issue</th>
                <th>Created By</th>
                <!-- <th>Start Sprint</th> -->
                <th>Action</th>
            </tr>
        </tfoot>
      </table>
   
      <?php 

      } 

    ?>
  </div>
</div>


<style type="text/css">



.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
    width: 180px;
}

  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
</style>

<script>

  
  $('#start_date').on("change", function(){

     // let duration =$("#duration").val();
      
   })

   

</script>

@include('projects::employee.footer')


