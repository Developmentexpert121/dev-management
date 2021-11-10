@include('projects::company.header') 

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
  <h3>Backlog</h3>  

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

              foreach($sprintIssue as $data)
              {
                ?> 

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

                  <!-- Modal -->
                  <div class="modal fade" id="moveSprint{{$data->id}}" role="dialog">
                    <div class="modal-dialog"> 
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                          <h4 class="modal-title"> Move BackLog</h4>
                        </div>
                        <div class="modal-body">

                        
                    <form class="row align-items-center" action='{{url("projects/company/sprint/blackLogMove")}}' method='post'>
                    <input type="hidden" name="_token" id="csrf" value="<?php echo csrf_token(); ?>">
               
                    <input type='hidden' id ="project_id" name='project_id' value='{{$project_id}}'/>
                   <input type="hidden" id="sprint_id" name="sprint_id" value="{{$data->id}}"/> 
 
                     <div class="row">

                     <div class="col-6"> 
                     <div class="form-outline">
                       <b>back log issue( {{$data->issue_name}} )</b><br><br>
                     <label>Select Sprints </label>  
                      
                     <select id="action" class="action" name='sprint'> 
                     <option value="">Please Select Sprint</option> 
                         <?php  foreach($sprints as $val){?>
                       <option value="<?php $val->id ?>"><?php echo $val->sprint_name ?></option> 
     
                       <?php  } ?>
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
              </td> 
              </tr> 

            <?php } ?> 
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
