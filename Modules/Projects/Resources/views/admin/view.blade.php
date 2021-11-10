@include('projects::admin.header')


    <div class="main-panel">    
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Project Detail </h4>
                  <div  class="form-group ">
                  <?php if(!empty($project_data->image)){ ?> 
                  <img src="{{ asset('/user/images/' . $project_data->image) }}" width="100" height="100" > <?php }else{ ?> 
                    <img src="{{asset('storage/images/No-Image.png')}}" width="100" height="100" >
                    <?php } ?> 
                  </div>

     
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name</strong>
                                <p><?php echo $project_data->name ?><p>
                            </div>
                        </div>  

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>key</strong><br>
                                <p><?php echo $project_data->key ?><p>
                                
                            </div>
                        </div>
                      <?php
                      if($project_data->template==1){
                        $templatename='Kanban';
                    }elseif($project_data->template==2){
                        $templatename='Scrum'; 
                    }elseif($project_data->template==3){
                        $templatename='Bug';
                    }

                    if($project_data->project_type == 1){
                      $project_type='Team';
                      $project_name = 'team';
                   }else{
                      $project_type='Company';
                      $project_name = 'company';
                  }
                    ?>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Template</strong><br>
                                <p><?php echo $templatename?><p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Project Type</strong>
                                <p><?php echo $project_type ?><p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description</strong>
                                <p><?php echo $project_data->Description ?><p>
                            </div>
                        </div>

                    </div>


                </div>
              </div>
              </div>
            </div>
          </div>
          @include('projects::admin.footer') 
</div>
</div>
           
        

            