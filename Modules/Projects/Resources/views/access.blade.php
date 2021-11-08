@include('projects::admin.header')
<div class="main-panel">    
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <a class="access_text">Projects</a>&nbsp;/&nbsp;<a href="">Team</a>&nbsp;/&nbsp;<a href="">Project settings</a>
            <div>
              <h4 class="mt-2 access">Access</h2>
                <h6>Project access</h6>
              <div class="row">
                  <div class="col-md-4">
                   <p> Name</p>
                   <hr>
                   <p>{{$user_access->name}}</p>
                  </div>
                  <div class="col-md-4">
                    <p>Email</p>
                    <hr>
                    <p>{{$user_access->email}}</p>
                  </div>
                  <div class="col-md-4">
                    <p>Role</p>
                    <hr>
                      <?php if(!empty($user_access) && $user_access['user_role']==1){ 
                              echo  '<input type="text" disabled name="teamleader" value="Teamleader">';
                      
                             }else if(!empty($user_access) && $user_access['user_role']==2){  
                              echo  '<input type="text" disabled name="employee" value="Employee">';

                            }elseif (!empty($user_access) && $user_access['user_role']==3) {
                              echo  '<input type="text" disabled name="manager" value="Manager">';

                            }elseif (!empty($user_access) && $user_access['user_role']==4) {
                              echo  '<input type="text" disabled name="HR" value="HR">';
                            }
                            elseif(!empty($user_access) && $user_access['user_role']==5){
                              echo  '<input type="text" disabled name="administrator" value="Administrator">';
                            }else{
                              echo '';

                            }
                      ?>
                   <p></p>
                </div>
              </div>
              <hr>
              <div class="col-md-12" >
                <div class="access-image">
                <img src="{{ asset('uploads/access-default/intro-view.76f051ad8e0b01d4178163918dd46079.8.svg') }}" />
                <div class="access-text">
                <h2>Great work starts with a great team!</h2>
                </div>
                <span>Add the people you want to work on the project,</span><br>
                <span>and they'll get a link to join the action.</p>
               </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('projects::team.footer')
<style type="text/css">
  .access {
    font-weight: bold;
    font-size: 24px;
}
h6 {
    margin-top: 32px;
    font-size: large;
    color: #000;
    margin-bottom: 20px;
}
.access-image {
    text-align: center;
    margin-top: 80px;
}
.access-text {
    margin-top: 31px;
    font-weight: bold;
}
</style>