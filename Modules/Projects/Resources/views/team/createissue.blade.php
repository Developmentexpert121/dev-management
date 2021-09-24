@include('projects::team.header')



    <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Task Form</h4>
                  <p class="card-description">
                    Create Task
                  </p> 

                  @if ($errors->any())
                  <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                   </ul>
                  </div>  
                  @endif

                  @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                   @endif 
                   <div class='content' >

    <form action='{{url("admin/project/team/save_issue")}}' method="post" class="dropzone" enctype="multipart/form-data">
    <label>Project-></label>
 	    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
 	    <input type="hidden" name="project_id"  value="{{$project_id}}" />
 	   <select name="project_name" id="project" >
        <option> Please Select Project  </option>
              <?php 
               foreach($drop_down_data as $val){
              ?>
              <option value="<?php  echo $val->id ?>" <?php if($val->id == $project_id){ ?>selected="selected" <?php } ?>><?php  echo $val->name ?></option>
             
               <?php 
               }
             ?> 
           </select><br><br>
            Sprint Name-><select name="sprint" id="sprint" >
            <option value=""> Please Select Sprint Name  </option>
              <?php 
               foreach($sprint as $sprint_val){
              ?>
             <option value="<?php  echo $sprint_val->id ?> "> <?php  echo $sprint_val->sprint_name ?>
                 
             </option>
             
            <?php 
            }
             ?>
           </select><br><br>

           <label>Task type-></label>
           <select name="task_type">
            <option value="">Please Select Task Type</option>
         	<option value="Task">Task</option>
         	<option value="Story">Story</option>
         	<option value="Bug">Bug</option>
         	<option value="Epic">Epic</option>
           </select><br><br>

         <label>
         Summary->
         </label>
         <input type="text" name="summary" ><br><br>
         Description-><textarea class="form-control" id="summary-ckeditor" name="description"></textarea>
        <br><br>
         <label>Priority-></label>
         <select name="priority">
            <option value="">Please Select Priority</option>
         	<option value="Medium">Medium</option>
         	<option value="Highest">Highest</option>
         	<option value="High">High</option>
         	<option value="Lowest">Lowest</option>
         	<option value="Low">Low</option>

         </select><br><br>
    
      Reporter-> <input type="" name="reporter" value="{{$createdby->name }}" ><br><br>
      Assignee-><select name="assignee" id="assignee" >
               <option value="">Please Select Assignee</option>
              <?php 
               foreach($employee as $emp){
              ?>
             <option value="<?php  echo $emp->id ?> "> <?php  echo $emp->name ?>
                 
             </option>
             
            <?php 
            }
             ?>
           </select><br><br>
      

     <!--     <label>Browse or Drag the file here:</label>
         <input type="file" name="file" multiple><br><br>
 -->
      <button type="submit">Create</button>
               

                  </form>
        </div>
                </div>
              </div>
              </div>
            </div>
          </div>













<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>
<script>
        CKEDITOR.replace( 'text-area-id' );
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.instances["id"].getData();
</script>



<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".content",{ 
        maxFilesize: 3,  // 3 mb
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
    });
    myDropzone.on("sending", function(file, xhr, formData) {
       formData.append("_token", CSRF_TOKEN);
    }); 
    </script>

@extends('projects::team.footer')