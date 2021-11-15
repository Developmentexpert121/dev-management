@include('user::admin.header')
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

                  foreach($user_list as $data)
                  {
                    
                    if($data->user_role == 1){  $user_role='Team Leader'; }elseif($data->user_role == 2){ $user_role='Employee';  
                    }elseif($data->user_role == 3){ $user_role='Manager'; }elseif($data->user_role == 4){ $user_role='Hr'; }else{ $data->$user_role = 'Employee'; }
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
                <?php
                 } 
                ?>
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