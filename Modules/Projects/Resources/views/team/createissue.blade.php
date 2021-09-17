@include('projects::team.header')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>  
    @endif
 <form action='{{url("admin/project/team/save_issue")}}' method="post">
 	<label>Project</label>
 	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
 	<input type="hidden" name="project_id"  value="{{$project_id}}" />
 	   <select name="project_name" id="project" >
              <?php 
               foreach($drop_down_data as $val){
              ?>
             <option value="<?php  echo $val->id ?>" <?php if($val->id == $project_id){ ?>selected="selected" <?php } ?>><?php  echo $val->name ?></option>
             
            <?php 
            }
             ?>
           </select><br><br>
           <label>Task type</label>
         <select name="task_type" >
         	<option>Task</option>
         	<option>Story</option>
         	<option>Bug</option>
         	<option>Epic</option>
         </select><br><br>

         <label>

         	Summary
         </label>
         <input type="text" name="summary" >
         <label>Description</label>
         <input type="textarea" name="description"><br><br>
         <label>Priority</label>
         <select name="priority">
         	<option>Medium</option>
         	<option>Highest</option>
         	<option>High</option>
         	<option>Lowest</option>
         	<option>Low</option>
         </select><br><br>
         <button type="submit">Create</button>
         
 </form>
@extends('projects::team.footer')