@include('user::profile.managesidebar')
  <div class="d-flex" id="wrapper">
    <!-- Page content wrapper-->
     <div class="container">
       <div class="row justify-content-center">
        <div class="col-md-8">
         <h4 class="mt-2">Security</h4>
          <h6>Change your password</h6>
           <div class="card">
                
                @if(session()->has('error'))
                    <span class="alert alert-danger">
                        <strong>{{ session()->get('error') }}</strong>
                    </span>
                @endif
                @if(session()->has('success'))
                    <span class="alert alert-success">
                        <strong>{{ session()->get('success') }}</strong>
                    </span>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="password" >Current Password</label>
                            <div class="col-md-8">
                              <i class="far fa-eye" id="togglePassword"></i>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current_password" placeholder="Enter Current password" id="current_password" >
                                
                                @error('current_password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password">New Password</label>
                            <div class="col-md-8">
                             <!--  <i class="far fa-eye" id="toggleNewPassword"></i> -->
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" placeholder="Enter New password" id="newpassword">
                                <!-- <input type="checkbox" onclick="myFunction()">Show Password -->
                                @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password">Password Confirmation</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation" placeholder="Enter Confirm Password" id="password_confirmation">
                                
                                @error('password_confirmation')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Save changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="contentdata">
                 <h6>Two-step verification</h6>
                   <span>Keep your account extra secure with a second login step.</span><a class="sc-htoDjs FpGev" rel="noopener noreferrer" href="https://confluence.atlassian.com/x/p7X-Nw" target="_blank"><span>Learn more</span></a>
                  <a class="sc-jXQZqI iyTruZ" appearance="default" href="/manage-profile/security/two-step-verification"><span>Manage two-step verification</span></a>
            </div>
            <div class="contentdata">
                   <h6>API token</h6>
                    <span>A script or other process can use an API token to perform basic authentication with Jira Cloud applications or Confluence Cloud. You must use an API token if the Atlassian account you authenticate with has had two-step verification enabled. You should treat API tokens as securely as any other password.</span><a class="sc-htoDjs FpGev" rel="noopener noreferrer" href="https://confluence.atlassian.com/x/Vo71Nw" target="_blank"><span>Learn more</span></a><br>
                  <a class="sc-ccSCjj bEsaby" appearance="default" href="/manage-profile/security/api-tokens"><span>Create and manage API tokens</span></a>
            </div>
            <div class="contentdata">
                 <h6>Recent devices</h6>
                  <span>If you've lost one of your devices or notice any suspicious activity, log out of all your devices and take steps to secure your account.</span><a class="sc-htoDjs FpGev" rel="noopener noreferrer" href=" https://confluence.atlassian.com/cloud/recently-used-devices-976161184.html" target="_blank"><span>Learn more</span></a><br>
                 <a class="sc-eInJlc laKbNg" appearance="default" href="/manage-profile/security/recent-devices"><span>View and manage recent devices</span></a>
            </div>
            
        </div>
    </div>
                <!-- Top navigation-->
            
                        <!-- <button class="btn btn-primary" id="sidebarToggle">Full Screen</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->          
       </div>
  </div>
</div>
<script type="text/javascript">
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#current_password');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<!-- <script>
function myFunction() {
  var x = document.getElementById("newpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script> -->


<style type="text/css">
    #sidebar-wrapper {
    margin-left: 65px;
}
.fa-eye{

cursor: pointer;
}
div#wrapper {
    margin-top: 18px;
}
.container {
    margin-left: 5%;
    margin-right: 10%;
    margin-bottom: 2%;
}
span {
    font-size: 13px;
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
.contentdata {
    padding-top: 25px;
}
.mt-2 {
    margin-bottom: 10%;
}
</style>



