@include('user::cto.header') 

<div class="main-panel">    
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6">
                <a href='{{url("cto/project/template")}}'><button class="cr_btn">Create Project</button></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if(Session::has('message'))
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                        @endif
                        <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>key</th>
                                    <th>Created by</th>
                                    <th>Template</th>
                                    <th>Project Type</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody> 
                                <?php 

                                $i=1;
                                
                                foreach($project_list as $data)
                                {
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

                                    if($data->project_type==1)
                                    {
                                        $project_type='Team';
                                        $project_name = 'team';
                                    }
                                    else
                                    {
                                        $project_type='Company';
                                        $project_name = 'company';
                                    }
                                    ?>
                                    <tr> 
                                        <td><?php echo $i++  ?></td> 
                                        <td><a href='{{url("admin/project/{$project_name}/{$data->id}")}}'><?php echo ucfirst($data->name);  ?></a></td>
                                        <td><?php echo ucfirst($data->key) ; ?></td>
                                        <td><?php echo ucfirst($data->username) ; ?></td> 
                                        <td><?php echo $templatename ; ?></td>
                                        <td><?php echo $project_type ;?></td>
                                        <td><a href='{{url("admin/project/view/{$data->id}")}}'><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href='{{url("admin/project/{$data->id}/settings")}}'><i class="fa fa-edit" style="font-size:18px;color:green"></i></a>
                                            <a Onclick="return ConfirmDelete();" href='{{url("admin/project/delete/{$data->id}")}}'><i class="fa fa-trash-o fa-lg" style="font-size:21px;color:red"></i>
                                        </td>
                                            
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

<style type="text/css">
    .cr_btn { -webkit-box-align: center; align-items: center; border-width: 0px; border-radius: 3px; box-sizing: border-box; display: flex; font-size: inherit; font-style: normal; font-family: inherit; font-weight: 500; max-width: 100%; position: relative;    text-align: center; text-decoration: none; transition: background 0.1s ease-out 0s, box-shadow 0.15s cubic-bezier(0.47, 0.03, 0.49, 1.38) 0s; white-space: nowrap; background: rgb(9 147 20); color: rgb(255, 255, 255); cursor: pointer; height: 48px;    line-height: 40px; padding: 0px 10px; vertical-align: middle; width: 420px; -webkit-box-pack: center; justify-content: center;outline: none;  margin: 0px 0px 6px; }
    a , a:hover { text-decoration: none; }
</style>
@include('projects::admin.footer')

<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }
</script>