@include('user::admin.header')


    <div class="main-panel">    
        
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>  
    @endif  

        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Users</h4>
                  <p class="card-description">
                    Edit User Add 
                  </p>

                  @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                   @endif 

                  <form class="forms-sample" action='{{url("admin/edit/users/data")}}' method='post' enctype="multipart/form-data">

                      {{ csrf_field()}}
                     <input type='hidden' name='edit_id' value="<?php echo $user_data->id; ?>" />

                     <div  class="form-group ">

                     <label for="files" class="btn col-md-3"> 
                     <img src="<?php echo $url_link.'/'.$user_data->image ?>" width="100" height="100" />
                     <input id="files" style="visibility:hidden;" type="file" name='edit_image'></label>
                    
                      </div>

                    <div class="form-group">
                    
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" id="name" name='name' placeholder="Username" value="<?php echo $user_data->name ?>">
                    </div>
                  
                
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">User Role</label>

                        <select name="user_role" id="cars" class="form-control" >
                          <option value="1" <?php if($user_data->user_role==1){ ?> selected <?php } ?> >Team Leader</option>
                          <option value="2" <?php if($user_data->user_role==2){ ?> selected <?php } ?>>Employee</option>
                          <option value="3" <?php if($user_data->user_role==3){ ?> selected <?php } ?>>Manager</option>
                          <option value="4" <?php if($user_data->user_role==4){ ?> selected <?php } ?>>Hr</option>
                        </select>
                    </div>
                       
                   
                     
                    <button type="submit" class="btn btn-primary me-2">Edit</button>

                  </form>

                </div>  
              </div>
              </div>
            </div>
          </div>

          @include('user::admin.footer') 
</div>
</div>
           
        

            