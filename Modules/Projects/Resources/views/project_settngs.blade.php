@include('projects::admin.header')
<div class="main-panel">    
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action='{{url("projects/team/project/settings_save")}}' method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type='hidden' name='project_id' value='{{$project_id}}'/>
                <!-- <input type='hidden' name='project_type' value='1'/> -->
                <img class="setting_image" src="" alt="{{$project_data->name}}"><br>
                <input type="file" name="project_image">
                <div class="form-group">
                  <label for="exampleInputUsername1">Name</label>
                  <input type="text" class="form-control" id="name" name='name' placeholder="Project Name" value="{{$project_data->name}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Key</label>
                  <input type="text" class="form-control" id="key" name='key' placeholder="key" value="{{$project_data->key}}" readonly>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                  <select class="form-control" name="category">
                    <option value="">Select</option>
                  </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Project Lead</label>
                  <select class="form-control" name="project_lead">
                    <option value="">Select</option>
                  </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Default Assignee</label>
                  <select class="form-control" name="project_assignee">
                    <option value="">Select</option>
                  </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary me-2" >Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('projects::team.footer')