

@include('projects::admin.header')
<meta name="csrf-token" content="{{ csrf_token() }}" />


<div class="main-panel">    
        
        <div class="row" > 
                

             <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                           <div class="card card-rounded">

                              <div class="card-body">
                             
                              @if ($errors->any())
                               <div class="alert alert-danger">
                              <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                 @endforeach
                              </ul>
                              </div>  
                              @endif 

                   @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                   @endif 

                  <form class="forms-sample" action='{{url("admin/project/scrum/team_management/insert")}}' method='post'>

                   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


                             <div class="form-group">
                              <label for="exampleInputUsername1">Name</label>
                             <input type="text" class="form-control" id="name" name='name' placeholder="Project Name" >
                             </div>

                               <input type='hidden' name='template' value='2'/>
                               <input type='hidden' name='project_type' value='1'/>

                              <div class="form-group">
                              <label for="exampleInputEmail1">key</label>
                              <input type="text" class="form-control" id="key" name='key' placeholder="key" readonly>
                              </div>
                                
                              <button type="submit" class="btn btn-primary me-2" >Submit</button>

                                </form>

                              </div>

                       </div>
                  </div>
               </div>
             </div>  

       
      </div>
</div>



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
                 $("#key").val(response.message)

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
    @include('projects::admin.footer')
   </div>
   </div>
