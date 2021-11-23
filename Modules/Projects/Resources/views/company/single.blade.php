
@include('projects::company.header')

<div class="main-panel">    

  <div class="content-wrapper">

    <div class="row">
      <div class="col-md-6"><h4>Project</h4></div>
      <div class="col-md-6">{{$project_data->name}}</div>
    </div> 

    <div class="row">
      <div class="col-md-6"><h4>Key</h4></div>
      <div class="col-md-6">{{$project_data->key}}</div>
    </div>

  </div>

</div>

@include('projects::company.footer')