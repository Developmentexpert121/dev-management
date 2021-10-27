@include('user::admin.header')
      
    <div class="main-panel">    
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
                      <input type="text" class="form-control" value="{{old('name')}}" id="name" name='name' placeholder="Username">
                      @if($errors->has('name'))
                      <div class="error">{{ $errors->first('name') }}</div>    
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="email" value="{{old('email')}}" name='email' placeholder="Email">
                      @if($errors->has('email'))
                      <div class="error">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" value="{{old('password')}}" id="password"  name='password' placeholder="Password">
                      @if($errors->has('password'))
                      <div class="error">{{ $errors->first('password') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Confirm Password</label>
                      <input type="password" class="form-control"  value="{{old('password_confirmation')}}"  id="password_confirmation" name='password_confirmation'  placeholder="Password">
                      @if($errors->has('password_confirmation'))
                      <div class="error">{{ $errors->first('password_confirmation') }}</div>
                      @endif
                    </div>
                    
                      
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">User Role</label>

                        <select name="user_role" id="cars" class="form-control" >
                        <option value="">Please Select User Role</option>
                          <option value="1" <?php if(old('user_role') == '1'){ echo 'selected'; } ?>>Team Leader</option>
                          <option value="2" <?php if(old('user_role') == '2'){ echo 'selected'; } ?>>Employee</option>
                          <option value="3" <?php if(old('user_role') == '3'){ echo 'selected'; } ?>>Manager</option>
                          <option value="4" <?php if(old('user_role') == '4'){ echo 'selected'; } ?> >Hr</option>
                        </select>
                        @if($errors->has('user_role'))
                      <div class="error">{{ $errors->first('user_role') }}</div>
                      @endif
                    </div> 

                    <div class="form-group">
                     <input type="file" name="image" >
                     @if($errors->has('image'))
                      <div class="error">{{ $errors->first('image') }}</div>
                      @endif
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
           
        

            