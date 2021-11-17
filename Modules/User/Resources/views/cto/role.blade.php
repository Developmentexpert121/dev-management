@include('user::cto.header')



<div class="container">
  
    <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="row" > 
             <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                           <div class="card card-rounded">

                              <div class="card-body">

                              
                                    <form class="forms-sample" action='{{url("ceo/create/role")}}' method='post'>

                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                      
                                              <div class="form-group">
                                                <label for="exampleInputUsername1">Role Name</label>
                                              <input type="text" class="form-control" id="name" name='name' placeholder="Please Enter Role Name"  value="{{old('name')}}">
                                              @if($errors->has('name')) 
                                                <div class="error">{{ $errors->first('name') }}</div>
                                              @endif
                  
                                              </div>
                                        
                                    

                                                <div class="form-group">

                                                <label for="exampleInputEmail1">Slug</label> 
                                                <input type="text" class="form-control" id="slug" name='slug' value="{{old('slug')}}" placeholder="Slug Name" readonly>
                                                @if($errors->has('slug'))
                                                <div class="error">{{ $errors->first('slug') }}</div>
                                                @endif
                                              </div>
                                          
                                                  
                                                <button type="submit" class="btn btn-primary me-2" >Create Role</button>

                                      </form>

                              </div>

                       </div>
                  </div>
               </div>
             </div>  
      </div> 


@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif  





  <div class="row" style="width: 100%;">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
   

    <?php if(!empty($role)){ 
      ?>

      <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
          <tr>
              <th>Sr.No</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
              $i=1;

              $default = array("1","2","3","4", "5", "6","7","8","9");


              foreach($role as $data){
                ?>
                <tr> 
                    <td>{{$i++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->slug}}</td>
                    <td>  

                      <?php 
                        
                          if (in_array($data->id,$default))
                          {
                          echo "<b>Default</b>";
                          }
                          else
                          {
                       ?>

                           <a href="#"> <i class="fa fa-trash-o fa-lg" style="font-size:21px;color:red"  data-toggle="modal" data-target="#delete{{$data->id}}"></i> </a>
                          &nbsp; &nbsp;  

                           <a href="#"> <i class="fa fa-edit" style="font-size:18px;color:green"></i> </a>

                       <?php
                          
                          }


                     ?>

                    
                     
               
              </td>
                </tr>  


                <!-- Modal delete -->
                <div class="modal fade" id="delete{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content"> 
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are You Sure You Want Delete This Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                       <form class="forms-sample" action='{{url("admin/delete/role")}}' method='post'>

                         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                         <input type="hidden" name="role_id" value="{{$data->id}}"> 
                         <button type="submit" class="btn btn-primary me-2" >Yes</button> 
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> 

                        </form> 
                                              
                      </div>
                     
                    </div>
                  </div>
                </div>


            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
           
            </tr>
        </tfoot>
      </table>
    <?php } ?>
  </div>

</div>
<style type="text/css">
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
</style>
@include('projects::admin.footer')
<script type="text/javascript">
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();
  if(month < 10){
    month = '0' + month.toString();
  }
  if(day < 10){
    day = '0' + day.toString();
  }
  var maxDate = year + '-' + month + '-' + day;
  $('.startDate').attr('min', maxDate);
  $('.endDate').attr('min', maxDate);
</script>


<script>

	$(document).ready(function(){


      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $("#name").change(function(){ 
       var name = $(`#name`).val();
      
        $.ajax({
           url:"{{ url('admin/project/scrum/slug') }}",
           method:'POST',
           data:{
                 name:name
                },
           success:function(response)
           {
              if(response.success)
              {
                 $("#slug").val(response.message)

              }
              else
              {
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
	   });
	
			
		})

     </script>