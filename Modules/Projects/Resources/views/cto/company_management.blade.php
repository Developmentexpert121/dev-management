
@include('user::cto.header')
<meta name="csrf-token" content="{{ csrf_token() }}" />


<div class="main-panel">    
        
        <div class="row" > 

             <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                           <div class="card card-rounded">

                              <div class="card-body">
                             
                        


                  @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                   @endif             
                     

                  <form class="forms-sample" action='{{url("cto/project/scrum/company_management/insert")}}' method='post'>

                   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


                             <div class="form-group">
                              <label for="exampleInputUsername1">Name</label>
                             <input type="text" class="form-control" id="name" name='name'  value="{{old('name')}}" placeholder="Project Name" >
                             @if($errors->has('name'))
                           <div class="error">{{ $errors->first('name') }}</div>
                             @endif
                           </div>

                               <input type='hidden' name='template' value='2'/>
                               <input type='hidden' name='project_type' value='2'/>

                              <div class="form-group">
                              <label for="exampleInputEmail1">key</label>
                              <input type="text" class="form-control" id="key" name='key' value="{{old('key')}}" placeholder="key" readonly>
                              @if($errors->has('key'))
                           <div class="error">{{ $errors->first('key') }}</div>
                             @endif
                           </div>
                                
                              <button type="submit" class="btn btn-primary me-2" >Create Project</button>

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
                 console.log(response.message);
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

