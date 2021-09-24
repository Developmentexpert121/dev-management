@include('projects::team.header')
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sprint Form</h4>
                  <p class="card-description">
                    Create Sprint
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

    
                    
    @include('projects::team.footer') 











