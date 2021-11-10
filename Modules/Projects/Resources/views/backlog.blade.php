@include('projects::admin.header') 


<style>


.del-class{
  text-decoration: line-through;
}
.no-del-class{
  text-decoration: 'none';
}


</style>


<div class="container">
  
  <div class="row" style="width: 100%;">
  <h3> Backlog </h3>   

  @if(Session::has('message'))
 <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
 @endif

    <?php if(!empty($sprintIssue)){ ?>
      <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
          <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Issue Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

              $i=1;
              ?>

              @foreach ($sprintIssue as $data)
            
                  <tr> 
                    <td>{{$i++}}</td>
                    <td id="{{$data->id}}">
               
                    {{$data->issue_name}}
                    </td> 

                    <td class="action_td" aa="{{$data->id}}">  
                     Back Blog
                    </td>

                    <td> 
            
                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#moveSprint{{$data->id}}">Move To Sprint</button>

                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#edit{{$data->id}}">Edit</button>

                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#delete{{$data->id}}">Delete</button>
    
                  <!-- Modal Move issue start  --> 
                  <div class="modal fade" id="moveSprint{{$data->id}}" role="dialog">
                    <div class="modal-dialog"> 
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                          <h4 class="modal-title"> Move BackLog</h4>
                        </div>
                        <div class="modal-body">

                    <form class="row align-items-center" action='{{url("projects/team/sprint/blackLogMove")}}' method='post' data-parsley-validate="parsley">
                     
                      <input type="hidden" name="_token" id="csrf" value="<?php echo csrf_token(); ?>">
                      <input type='hidden' id ="project_id" name='project_id' value='{{$project_id}}'/>
                      <input type="hidden" id="sprint_id" name="sprint_id" value="{{$data->id}}"/>  
 
                      <div class="row"> 
                     
                      <div class="col-6"> 
                      <div class="form-outline">
                        <b>back log issue( @if(!empty($data->issue_name)){{$data->issue_name}}  @endif )</b><br><br> 
                       <label>Select Sprints </label>   
                      
                       <select id="action" class="action" name='sprint' required="true"> 
                       <option value="">Please Select Sprint</option> 
                        
                       
                        @if(!empty($sprints))
                        @foreach ($sprints as $val)
                        <option value="{{$val->id}}">{{$val->sprint_name}}</option> 
                        @endforeach
                        @endif


                       </select>   
                       </div>  
                        
                       @if($errors->has('sprint'))
                       <div class="error">{{ $errors->first('blacklogIssueCreate') }}</div>
                       @endif
                       <br>
                       </div>
                      </div>       
                         
                      <div class="row">
                      <div class="col-2">
                      <button type="submit" class="btn btn-primary">Move</button>
                      </div>
                      </div>  
             
                      </form>

              </div>
                       
               </div>
                      
              </div>
            </div> 
            <!-- Modal Move issue End  --> 




            <!--  Edit Model Start-->
           
                <!-- Modal --> 
                <div class="modal fade" id="edit{{$data->id}}" role="dialog">

                    <div class="modal-dialog"> 
                    
                      <!-- Modal content-->
                      <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                              <h4 class="modal-title"> Edit BackLog</h4>
                            </div>

                            <div class="modal-body">


                        <form class="row align-items-center" action="http://127.0.0.1:8000/projects/team/edit/blackLog/{{$data->id}}" method="post" data-parsley-validate="parsley">
                          <input type="hidden" name="_token" id="csrf" value="<?php echo csrf_token(); ?>">
        
                         <div class="row"> 

                            <div class="col-6">   
                            <div class="form-outline">
                            <label>Name</label>
                              <input type="text" id="blacklog" name="blacklogIssue" value="{{$data->issue_name}}" class="form-control" placeholder="Enter a sprint here" required="true">
                            </div> 
                              <br>
                            </div>
                         </div>      
                      
                         <div class="row">
                           <div class="col-2">
                            <button type="submit" class="btn btn-primary">Edit</button>
                           </div>
                         </div>

                      
                       </form>  
                    
                            </div>
                       
                       </div>
                      
                   </div>
              </div> 
        

             <!--  Edit Model End-->




              <!-- Modal --> 
              <div class="modal fade" id="delete{{$data->id}}" role="dialog">

                  <div class="modal-dialog"> 

                    <!-- Modal content-->
                    <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            <h4 class="modal-title">Confirmation Message</h4>
                          </div>

                          <div class="modal-body">
    

                      <form class="row align-items-center" action="http://127.0.0.1:8000/projects/team/delete/blackLog/{{$data->id}}" method="post" data-parsley-validate="parsley">
                      <input type="hidden" name="_token" id="csrf" value="<?php echo csrf_token(); ?>">
                      
                      <div class="row">  

                         <div class="col-6">   
                           <div class="form-outline">
                              <label><b>Are You Sure You Want Delete This Backlog</b></label>
                           </div>  
                           <br>  
                         </div>
                           
                      </div>      
                      
                      <div class="row">
                        <div class="col-2">
                          
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                        </div> 
                      </div>

                    
                     </form>   

                      </div>
                    
                    </div>
                    
                  </div>
            </div> 

               
              </td> 
              </tr> 

              @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr.No</th> 
                <th>Name</th>
                <th>Issue Status</th> 
                <th>Action</th> 
            </tr>
        </tfoot>
      </table>
    <?php } ?>
  </div>
</div>

@include('projects::admin.footer')
