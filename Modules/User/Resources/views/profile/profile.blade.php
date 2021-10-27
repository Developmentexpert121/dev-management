
<!------ Include the above in your HEAD tag ---------->
<header>
    @include('user::profile.header')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</header>

<div class="container emp-profile">
                
                <div class="row">
                    <div class="col-md-4">

                        <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)" >
                  
            <div class="row">
                <div class="col-md-4 mb-2">
                     <?php if (!empty ($profiledata->image)){ ?>
                    <img id="image_preview_container"   src="http://localhost/dev-management/storage/app/image/{{$profiledata->image}}"  alt="preview image" style="max-height: 150px;">
                    <?php }else{ ?> 
                     <img id="image_preview_container"  src="http://localhost/dev-management/storage/app/image/default/image-1634637893.png"  alt="preview image" style="max-height: 150px;">
                <?php } ?> 
                       
              </div>
                <div class="col-md-5 test">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                        <span class="text-danger">{{ $errors->first('title') }}</span>

                    </div>
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
             </div>     
        </form>      
        <div class="row">
                    <div class="col-md-8 manage-profile">
                        <div bis_skin_checked="1"><a target="_blank" class="css-oyr9u8" href="http://127.0.0.1:8000/admin/user/manage-profile/profile-and-visibility" tabindex="0"><span class="css-19r5em7"></span>
                            <button>Manage your account</button></a></div>
                    </div>
                </div> 
                        <!-- <div class="profile-img">
                        </div> -->
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h4>
                                       Worked on
                                    </h4>
                                    <span>Others will only see what they can access.</span>
                         </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <h4>{{$task->name}}</h4><br/>
                             <p class="text-success job_title_msg"></p>
                             <p class="text-success job_title_msgF"></p>
                             <p class="text-success job_title_msgs"></p>
                             <p class="text-success job_title_msgt"></p>    

                            <form id="profile_form" method="post" name="profile">
                                @csrf
                                
                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path fill="currentColor" fill-rule="evenodd" d="M17 14h2V9H5v5h2v-1a1 1 0 012 0v1h6v-1a1 1 0 012 0v1zm0 2v1a1 1 0 01-2 0v-1H9v1a1 1 0 01-2 0v-1H5v3h14v-3h-2zM9 7h6V6H9v1zM7 7V5a1 1 0 011-1h8a1 1 0 011 1v2h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path></svg>

                           <input type="text" id="job_title" name="job_title" placeholder="your-job-tittle" class="blur" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata['job_title'];}else{ echo '';} ?>"><br/><br/>

                          
                            
                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path fill="currentColor" d="M11 5v2h2V5h-2zm0 6V9h-1a1 1 0 01-1-1V4a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-1v2h5a1 1 0 011 1v3h1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4a1 1 0 011-1h1v-2H7v2h1a1 1 0 011 1v4a1 1 0 01-1 1H4a1 1 0 01-1-1v-4a1 1 0 011-1h1v-3a1 1 0 011-1h5zm-6 6v2h2v-2H5zm12 0v2h2v-2h-2z"></path></svg>
                           <input type="text" id="your_department" name="your_department" placeholder="Your department" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata->your_department;}else{ echo '';} ?>"><br/><br/>

                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><g fill="currentColor" fill-rule="evenodd"><path d="M8 6H5.009C3.902 6 3 6.962 3 8.15v10.7C3 20.04 3.9 21 5.009 21h5.487H8v-2.145c-1.616-.001-3-.003-3-.004 0 0 .005-10.708.009-10.708L8 8.144V6z" fill-rule="nonzero"></path><path d="M12 7h2v2h-2zm-6 3h2v2H6zm0 3h2v2H6zm6-3h2v2h-2zm0 3h2v2h-2zm2 3h2v3h-2zm2-9h2v2h-2zm0 3h2v2h-2zm0 3h2v2h-2z"></path><path d="M18.991 19C18.998 19 19 4.995 19 4.995c0 .006-7.991.005-7.991.005C11.002 5 11 19 11 19h7.991zM9 4.995C9 3.893 9.902 3 11.009 3h7.982C20.101 3 21 3.893 21 4.995v14.01A2.004 2.004 0 0118.991 21H9V4.995z" fill-rule="nonzero"></path></g></svg>
                          <input type="text" id="your_organisation" name="your_organisation" placeholder="Your organisation" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata->your_organisation;}else{ echo '';} ?>"><br><br>

                           
                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21c-2.28 0-6-8.686-6-12a6 6 0 1112 0c0 3.314-3.72 12-6 12zm0-9a2.912 2.912 0 100-5.824A2.912 2.912 0 0012 12z" fill="currentColor" fill-rule="evenodd"></path></svg>
                            <input type="text" name="your_location" id="your_location" placeholder="Your location" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata->your_location;}else{ echo '';} ?>"><br/><br/>

                            <span>Contact</span><br/><br/>
                            <div><svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><g fill="currentColor" fill-rule="evenodd"><path d="M5 7v10h14V7H5zm14-2c1.1 0 2 .9 2 2v10c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V7c0-1.1.9-2 2-2h14z" fill-rule="nonzero"></path><path d="M5.498 6.5H3.124c.149.44.399.854.75 1.205l5.882 5.881a3.117 3.117 0 004.41 0l5.882-5.881c.35-.351.6-.765.749-1.205h-2.373l-5.672 5.672a1.119 1.119 0 01-1.583 0L5.498 6.5z"></path></g></svg>
                            
                            </form>
                            <span>{{$task->email}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="http://localhost/dev-management/Modules/User/Resources/views/profile/WorkListEmpty.4f661661cc7870531cec33801ddb8b45.8.svg" width="120px" height="120px">
                                            </div>
                                            <div class="col-md-6">
                                                <h4>There is no work to see here</h4>
                                                <span>Things you created, edited or commented on in the last 90 days.</span>
                                            </div>
                                        </div> 
                                </div>
                         </div>
                    </div>
                 </form>
                     
                </div>
                
                @include('user::profile.footer')

<script>
$('#job_title').focusout(function(event){

    $.ajax({
      url: "/user/user_job_title", //Define Post URL
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        "job_title":$(this).val(),
       
      },
      success: function(response){
        //$('.message').html(response.message);
        $('.job_title_msg').html(response.message).delay(2000).fadeOut('slow');
   },
  });
});
$('#your_department').focusout(function(event){
    
    $.ajax({
      url: "/user/your_department", //Define Post URL
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        "your_department":$(this).val(),
      },
      success: function(response){
        //$('.message').html(response.message);
        $('.job_title_msgF').html(response.message).delay(2000).fadeOut('slow');
   },
  });
});
$('#your_organisation').focusout(function(event){
    
    $.ajax({
      url: "/user/your_organisation", //Define Post URL
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        "your_organisation":$(this).val(),
      },
      success: function(response){
        //$('.message').html(response.message);
        $('.job_title_msgs').html(response.message).delay(2000).fadeOut('fast');
   },
  });
});
$('#your_location').focusout(function(event){
    
    $.ajax({
      url: "/user/your_location", //Define Post URL
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        "your_location":$(this).val(),
      },
      success: function(response){
        //$('.message').html(response.message);
        $('.job_title_msgt').html(response.message).delay(2000).fadeOut('slow');
   },
  });
});

</script>
<style type="text/css">
    .col-md-4 {
       text-align: center;
         }
</style>

<script type="text/javascript">
    $(document).ready(function (e) {
   
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });
  
   $('#image').change(function(){
           
    let reader = new FileReader();

    reader.onload = (e) => { 

      $('#image_preview_container').attr('src', e.target.result); 
    }

    reader.readAsDataURL(this.files[0]); 
  
   });
  
   $('#upload_image_form').submit(function(e) {

     e.preventDefault();
  
     var formData = new FormData(this);
  
     $.ajax({
        type:'POST',
        url: "{{ url('photo')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
           this.reset();
           alert('Image has been uploaded successfully');
        },
        error: function(data){
           console.log(data);
         }
       });
   });
});
</script>
<style type="text/css">
    a.css-oyr9u8 {
    margin-left: 18px;
}
.form-group {
    margin-left: 18px;
}
.manage-profile {
    margin-bottom: 50px;
}
.profile-work {
    padding: 0;
    margin-top: -15%;
}
/*.test {
    float: left;
    top: 83px;
}*/
</style>
