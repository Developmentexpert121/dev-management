@include('user::admin.header')
      
    <div class="main-panel">    
        <div class="content-wrapper user-main-bg">
          <div class="row">
            <div class="col-md-6">
              <div class="user-content">
                <p>Admin / team-1600000000000</p>
                <p>Manage product access for all the users in your organization.</p>
                <p>learn more access settings</p>
                <p>There’s a team behind every sucess</p>
                <p>Add your team and start creating great things together</p>
              </div>

              <div class="user-card">
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
                      
                    <div class="form-group form-slide">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" value="{{old('name')}}" id="name" name='name' placeholder="Username">
                      @if($errors->has('name'))
                      <div class="error">{{ $errors->first('name') }}</div>    
                      @endif
                    </div>
                    <div class="form-group form-slide">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="email" value="{{old('email')}}" name='email' placeholder="Email">
                      @if($errors->has('email'))
                      <div class="error">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                    <div class="form-group form-slide">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" value="{{old('password')}}" id="password"  name='password' placeholder="Password">
                      @if($errors->has('password'))
                      <div class="error">{{ $errors->first('password') }}</div>
                      @endif
                    </div>
                    <div class="form-group form-slide">
                      <label for="exampleInputConfirmPassword1">Confirm Password</label>
                      <input type="password" class="form-control"  value="{{old('password_confirmation')}}"  id="password_confirmation" name='password_confirmation'  placeholder="Password">
                      @if($errors->has('password_confirmation'))
                      <div class="error">{{ $errors->first('password_confirmation') }}</div>
                      @endif
                    </div>
                    
                      
                    <div class="form-group form-slide">
                      <label for="exampleInputConfirmPassword1">User Role</label>
  
                        <select name="user_role" id="cars" class="form-control" >
                        <option value="">Please Select User Role</option>
                          <?php 
                           foreach($role as $userRole){
                             ?>
                            <option value="{{$userRole->id}}" <?php if(old('user_role') == $userRole->status){ echo 'selected'; } ?>>{{$userRole->name}}</option>
                            <?php
                           }
                          ?>
                         
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
            <div class="col-md-6 d-flex align-items-center">
              <div class="user-form">
                <img src="../../../images/auth/user-banner.png" class="w-100">
              </div>
            </div>     
          </div>
        </div>       
        
          @include('user::admin.footer') 
</div>
</div>
           
        

            