@include('user::admin.header')


    <div class="main-panel">    
        
 

        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View All Users </h4>
                  <div  class="form-group ">
                  <?php if(!empty($user_data->image)){ ?> 
                  <img src="{{ asset('/storage/images/' . $user_data->image) }}" width="100" height="100" > <?php }else{ ?> 
                    <img src="{{asset('storage/images/No-Image.png')}}" width="100" height="100" >
                    <?php } ?> 
                  </div>

     
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name</strong>
                                <p><?php echo $user_data->name ?><p>
                            </div>
                        </div>  

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>email</strong>
                                <p><?php echo $user_data->email ?><p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role</strong><br>
                                <?php 
                                if($user_data->user_role==1)
                                {
                                    echo $role='Team Leader';
                                  }
                                   elseif($user_data->user_role==2)
                                   {
                                     echo  $role='Employee';  
                                   }  
                                   elseif($user_data->user_role==3)
                                   {
                                     echo $role='Manager';
                                   }  
                                   elseif($user_data->user_role==4)
                                   {
                                      echo  $role='Hr';
                                  } 
                                ?>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Date Created</strong><br>
                                <p><?php echo $user_data->created_at ?><p>
                            </div>
                        </div>

                    </div>


                </div>
              </div>
              </div>
            </div>
          </div>

          @include('user::admin.footer') 
</div>
</div>
           
        

            