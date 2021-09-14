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
                  <h4 class="card-title">Users</h4>
                  <p class="card-description">
                    New User Add
                  </p> 

                  @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                   @endif 

                  <form class="forms-sample" action='{{url("admin/newuser")}}' method='post' enctype="multipart/form-data">

                      {{ csrf_field()}}
                      
                    <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" id="name" name='name' placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="email" name='email' placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="password"  name='password' placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Confirm Password</label>
                      <input type="password" class="form-control" id="password_confirmation" name='password_confirmation'  placeholder="Password">
                    </div>
                    
                      
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">User Role</label>

                        <select name="user_role" id="cars" class="form-control" >
                        <option value="">Please Select User Role</option>
                          <option value="1">Team Leader</option>
                          <option value="2">Employee</option>
                          <option value="3">Manager</option>
                          <option value="4">Hr</option>
                        </select>
                    </div> 

                    <div class="form-group">
                     <input type="file" name="image" >
                    </div>

                     
                    <button type="submit" class="btn btn-primary me-2">Submit</button>

                  </form>
 
                </div>
              </div>
              </div>
            </div>
          </div>

          @include('user::admin.footer') 
</div>
</div>
           
        

            