

@include('projects::header')
<meta name="csrf-token" content="{{ csrf_token() }}" />


<div class="main-panel">    
        
        <div class="row" > 
                

             <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                           <div class="card card-rounded">

                              <div class="card-body">
                             

                     

                  <form class="forms-sample" action='{{url("admin/newuser")}}' method='post' enctype="multipart/form-data">

                    
                      

                             <div class="form-group">
                              <label for="exampleInputUsername1">Name</label>
                             <input type="text" class="form-control" id="name" name='name' placeholder="Project Name" >
                             </div>

                              <div class="form-group">
                              <label for="exampleInputEmail1">key</label>
                              <input type="text" class="form-control" id="key" name='key' placeholder="key">
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
                  alert(response.message) 
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

