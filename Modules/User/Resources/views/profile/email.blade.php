@include('user::profile.managesidebar')

    <!-- Page content wrapper-->
     <div class="container">
       <div class="row justify-content-center">
        <div class="col-md-8">
      	 <h4 class="mt-2">Email</h4>
      	 <h6>Current email</h6>
      	 <span>Your current email address is <strong>{{$userdata->email}}</strong></span>
        </div>
       </div>
     </div>
  
