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
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">Create Issue</h4> 
               
              <form class="row align-items-center" action='{{url("projects/company/sprint/add_issue_create")}}' method='post'>
                <input type="hidden" name="_token" id="csrf" value="<?php echo csrf_token(); ?>">
               
                <input type='hidden' id ="project_id" name='project_id' value='{{$project_id}}'/>
                <input type='hidden' id ="sprint_id"  name='sprint_id' value='{{$sprint_id}}'/>
 
                 <div class="row">

                     <div class="col-6"> 
                     <div class="form-outline">
                     <label>Name</label>
                       <input type="text" id="form1" name="issueCreate" class="form-control" placeholder="Enter a sprint here" value="{{old('new_sprint')}}"/>
                     </div> 
                       
                      @if($errors->has('issueCreate'))
                      <div class="error">{{ $errors->first('issueCreate') }}</div>
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


  <div class="container">

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">BackLog</button>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">BackLog</h4>
        </div>
        <div class="modal-body">
        
         
        <form class="row align-items-center" action='{{url("admin/projects/team/sprint/blackLogIssueCreate")}}' method='post'>
                <input type="hidden" name="_token" id="csrf" value="<?php echo csrf_token(); ?>">
               
                <input type='hidden' id ="project_id" name='project_id' value='{{$project_id}}'/>
                <input type='hidden' id ="sprint_id"  name='sprint_id' value='{{$sprint_id}}'/>
 
                 <div class="row">

                     <div class="col-6"> 
                     <div class="form-outline">
                     <label>Name</label>
                       <input type="text" id="blacklog" name="blacklogIssueCreate" class="form-control" placeholder="Enter a sprint here" />
                     </div> 
                       
                      @if($errors->has('blacklogIssueCreate'))
                      <div class="error">{{ $errors->first('blacklogIssueCreate') }}</div>
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

  




  <div class="row" style="width: 100%;">



  @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

    <?php if(!empty($sprintIssue)){ ?>
      <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
          <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Action</th>
                <th>Delete</th>
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
                    @if($data->issue_status==2)
                    <del>{{$data->issue_name}}</del>
                    @else
                    {{$data->issue_name}}
                    @endif</td> 
                    <td class="action_td" aa="{{$data->id}}">  
                     
                         <select id="action" class="action"> 
                         <option value="0" <?php if($data->issue_status==0){ echo 'selected'; } ?> >To Do</option> 
                         <option value="1" <?php if($data->issue_status==1){ echo 'selected'; } ?>>In Progress</option> 
                         <option value="2" <?php if($data->issue_status==2){ echo 'selected'; } ?>>Done</option> 
                         </select>   
                    </td>
                    <td> 
                            <!-- Button trigger modal -->
                           <button type="button"  data-toggle="modal" data-target="#edit{{$data->id}}">
                           <i class="fa fa-pencil" title="Edit"></i>
                            </button>

                          <a href="<?php echo url('projects/team/sprint/delete/issue_create/'.$data->id) ?>" onclick="return confirm('Are you sure you want delete?')"><i class="fa fa-trash-o fa-lg"></i></a>
                          
                    </td> 
                </tr>  

                <!-- Modal -->
                <div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">Update Issue</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        

                      <form class="row align-items-center" action='{{url("projects/team/create/issue/update")}}' method='post' >  
                         
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   
                          <input type='hidden' name='project_id' value='{{$project_id}}'/>  
                          <input type='hidden' name='issue_id' value='{{$data->id}}'/>    
          
                          <div class="row">
                              <div class="col-6">
                                <div class="form-outline">
                                  <label>Issue Name</label>
                                  <input type="text" id="form1" name="issue_name" class="form-control" placeholder="Enter a sprint here" value="{{$data->issue_name}}" />
                                </div>
                                   
                                @if($errors->has('issue_name')) 
                                <div class="error">{{ $errors->first('issue_name') }}</div>
                                @endif     

                                <br>
                            </div>
                          </div>
                       
                          <div class="row">
                            <div class="col-2">
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>

                          </form> 


                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
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
                <th>Action</th> 
                <th>Delete</th>
            </tr>
        </tfoot>
      </table>
    <?php } ?>
  </div>
</div>


<script>

$('.action').change(function() 
{ 
  
  var issue_id = $(this).parent().attr('aa');
  var action = $(this).val();  
  var project_id = $("#project_id").val();
  var sprint_id = $("#sprint_id").val();
 

       $.ajax({
       
              url: "<?php  echo url('projects/sprint/create_issue/action')?>", 
              type: "POST",
              data: {
                "_token": "{{ csrf_token() }}", 
                "type": 1,
                "action": action, 
                "project_id":project_id, 
                "sprint_id":sprint_id,
                "issue_id" : issue_id

              },
              cache: false,
              success: function(response)
              {
                if (response.status == 200) 
                {
              
                  if(response.data == 1 || response.data ==0)
                  {

                    var element = document.getElementById(issue_id);
                    element.classList.remove("del-class");
                    element.classList.add("no-del-class");

                  }
                  else
                  {
                    var element = document.getElementById(issue_id);
                    element.classList.add("del-class");  
                  } 

                }
               
                  
              }
          });
   });

</script>




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