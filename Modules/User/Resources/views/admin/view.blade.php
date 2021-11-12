@include('user::admin.header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

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


              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="card-body">
                  <h4 class="card-title">Assign Project</h4>
                  <p class="card-description"> 
                    
                  </p>    
                  @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                   @endif  

                  <form class="forms-sample" action='{{url("admin/assign/project")}}' method='post'>
                            
                      {{ csrf_field()}}
                      


                    <div class="form-group form-slide">
  
                     
                          <select class="js-example-basic-multiple" name="assign_project[]" multiple="multiple">
                          <option value="">Please Select Project</option>
                          <?php
                          if(!empty($project_list))
                          {  
                          foreach($project_list as $data)
                           {
                            ?>
                              <option value="{{$data->id}}">{{$data->name}}</option>
                            <?php
                           }  
                          }
                          ?>
                        
                           </select>

                      </div>

                     
                    <button type="submit" class="btn btn-primary me-2">Assign</button>

                  </form>
 
                </div>
               </div>


            </div>
          </div>

           <script>

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

            </script>

          

          @include('user::admin.footer') 
</div>
</div>
           
        

            