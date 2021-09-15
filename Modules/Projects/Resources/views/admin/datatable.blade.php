@include('projects::admin.header')



<div class="main-panel">    
<a href='{{url("admin/project/template")}}' ><button>Create Project</button></a>
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
            <th>key</th>
            <th>Created by</th>
            <th>Template</th>
            <th>Project Type</th>
           
        </tr>
    </thead>

    <tbody>
   
     <?php 
     $i=1;
     foreach($project_list as $data){

        if($data->template==1)
        {
           $templatename='Kanban';
        }
        elseif($data->template==2)
        {
         $templatename='Scrum'; 
        }
        elseif($data->template==3)
        {
         $templatename='Bug';
        }


        if($data->project_type==1){
            $project_type='Team';
        }
        else{
            $project_type='Company';
        }
        
        ?>
        <tr> 
            <td><?php echo $i++  ?></td> 
            <td><?php echo $data->name;  ?></td>
            <td><?php echo $data->key  ?></td>
            <td><?php echo $data->username  ?></td> 
            <td><?php echo $templatename  ?></td>
            <td><?php echo $project_type ?></td>
    
        </tr>
     <?php } ?>
      
     
    </tbody>

    <tfoot>
        <tr>
            <th>Sr.No</th>
             <th>Name</th>
             <th>key</th>
             <th>Created by</th>
             <th>Template</th>
             <th>Project Type</th>
         </tr>
    </tfoot>

</table>
</div>
</div>
</div>
</div>
</div>
</div>

 

    @include('projects::admin.footer')


