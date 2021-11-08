    @include('user::profile.managesidebar')
    <div class="d-flex" id="wrapper">
    <!-- Page content wrapper-->
            <div class="container">
                <div id="page-content-wrapper">
                <!-- Top navigation-->
            <!-- 
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
                     
                <!-- Page content-->
                <div class="container-fluid">
                     <h4 class="mt-4">Profile and visibility</h4>
                         <p>Manage your personal information, and control which information other people see and apps may access.</p>
                            <a href="https://support.atlassian.com/atlassian-account/docs/update-your-profile-and-visibility-settings/">Learn more about your profile and visibility or view our privacy policy.</a>
                         </p>
                     <h3 class="sc-ipZHIp eyYZJN"><span>Profile photo and header image</span></h3>
                 <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)" >
                  
            <div class="row profile_box">
            <div class="col-md-4 mb-2">
                     <?php if (!empty ($profiledata->image)){ ?>

                         <img id="image_preview_container"   src="{{ asset('user/images/' . $profiledata->image)}}"  alt="preview image" style="max-height: 150px;">
                     <?php }else{ ?> 
                        <img id="image_preview_container"  src="{{ asset('user/images/default.png')}}"  alt="preview image" style="max-height: 150px;">

                     <?php } ?> 
                       
            </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                        <span class="text-danger">{{ $errors->first('title') }}</span>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                
                </div>

            </div>     
        </form> 
                <h3 class="sc-ipZHIp eyYZJN"><span>About you</span></h3>
                  <form method="post" >
                    @csrf
                  <p class="text-success job_title_msg"></p>
                             <p class="text-success job_title_msgF"></p>
                             <p class="text-success job_title_msgs"></p>
                             <p class="text-success job_title_msgt"></p>
                <div class="row">
                <div class="col-sm-8">
                    <label>Full name</label><br>
                    <input type="text" name="full_name" value="{{$task->name}}" readonly="readonly">
                </div>
                <div class="col-sm-4">
                    <label>who can see this?</label> <br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>
                <div class="col-sm-8">
                    <label>Public name</label><br>
                    <input type="text" name="public_name" value="{{$task->name}}" readonly="readonly">
                </div>
                <div class="col-sm-4">
                    <br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>
                    <div class="col-sm-8">
                    <label>Job title</label><br>
                    <input type="text" id="job_title" name="job_title" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata['job_title'];}else{ echo '';} ?>">
                </div>
                <div class="col-sm-4">
                    <br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>
                <div class="col-sm-8">
                    <label>Department</label><br>
                    <input type="text" id="your_department" name="department" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata->your_department;}else{ echo '';} ?>">
                    </div>
                <div class="col-sm-4">
                    <br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>    
                    <div class="col-sm-8">
                    <label>Organisation</label><br>
                    <input type="text" id="your_organisation" name="Organisation" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata->your_organisation;}else{ echo '';} ?>">
                </div>
                <div class="col-sm-4">
                    <br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>
                    <div class="col-sm-8">
                    <label>Based in</label><br>
                    <input type="text" id="your_location" name="your_location" value="<?php if ( !empty ($profiledata ) ){ echo $profiledata->your_location;}else{ echo '';} ?>">
                </div>
                <div class="col-sm-4">
                    <br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>
                <div class="col-sm-8">
                    <label>Local time</label><br>
                    <p>You have not set your time zone yet</p>
                </div>
                <div class="col-sm-4">
                    <br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>
               </div>
            
                 <h3 class="sc-ipZHIp eyYZJN"><span>Contact</span></h3>
                 <div class="row">
                 <div class="col-sm-8">
                    <label>Email address</label><br>
                    <p>{{$task->email}}</p>
                </div>
                <div class="col-sm-4">
                    <label>who can see this?</label><br>
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21a9 9 0 100-18 9 9 0 000 18zm-.9-1.863A7.19 7.19 0 014.8 12c0-.558.072-1.089.189-1.611L9.3 14.7v.9c0 .99.81 1.8 1.8 1.8v1.737zm6.21-2.286A1.786 1.786 0 0015.6 15.6h-.9v-2.7c0-.495-.405-.9-.9-.9H8.4v-1.8h1.8c.495 0 .9-.405.9-.9V7.5h1.8c.99 0 1.8-.81 1.8-1.8v-.369c2.637 1.071 4.5 3.654 4.5 6.669 0 1.872-.72 3.573-1.89 4.851z" fill="currentColor" fill-rule="evenodd"></path></svg>Anyone
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
         
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="http://localhost/dev-management/Modules/User/Resources/views/profile/js/scripts.js"></script>
    

<script type="text/javascript">
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
    #sidebar-wrapper {
    margin-left: 65px;
}
div#wrapper {
    margin-top: 18px;
}
.container {
    margin-left: 11%;
    margin-right: 10%;
}
span {
    font-size: 17px;
}
.col-sm-8 {
    padding: 10px;
}
form {
    font-size: small;
}
.profile_box {
    background-color: #d5d746ab;
}
img#image_preview_container {
    height: 100px;
    margin-top: 10px;
}
</style>