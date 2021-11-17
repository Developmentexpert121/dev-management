@include('user::cto.header')
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



<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            @if(Session::has('message'))
              <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $i=1;
                  foreach($user_list as $data){
                    
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $data->name; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td><?php echo $data->created_at; ?></td> 
                    <td>
                      <a href="<?php  echo url("admin/user/view/{$data->id}") ?>"> <i class="fa fa-eye" aria-hidden="true" ></i></a>  &nbsp; <a href="<?php  echo url("admin/user/delete/{$data->id}") ?>"><i class="fa fa-trash-o fa-lg" style="font-size:21px;color:red"></i> </a>&nbsp; &nbsp; <a href="<?php  echo url("admin/user/edit/{$data->id}") ?>"><i class="fa fa-edit" style="font-size:18px;color:green"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Sr.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('user::admin.footer') 