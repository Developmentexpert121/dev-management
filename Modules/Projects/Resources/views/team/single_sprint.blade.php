@include('projects::team.header')

<div class="main-panel">    

        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
<<<<<<< HEAD
                <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Project Name</th>
      <th scope="col">Sprint Name</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i=1;
     foreach($task_data as $data)
     { 
       
    ?> 
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{@$data['project_name']}}</td>
      <td>{{@$data['sprint_name']}}</td>
      <td>{{@$data['start_date']}}</td>
      <td>{{@$data['end_date']}}</td>
    </tr>
   <?php } ?>
  </tbody>
</table>

   
=======
              bghbnfhnhfbfjb
>>>>>>> 78b4940f56b5dd1616af9de10c3db15b80024d19
              
    
</div>
</div>
</div>
</div>
</div>
</div>

  @include('projects::team.footer')