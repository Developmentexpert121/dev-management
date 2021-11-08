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
                  </div>
                  <div class="col-md-4">
                    <p>Email</p>
                  </div>
                  <div class="col-md-4">
                    <p>Role</p>
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
}
</style>