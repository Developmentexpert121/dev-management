@include('projects::header')
<div class="main-panel">
  <div class="row">
    <div class="col-lg-8 d-flex flex-column">
      <div class="row flex-grow">
        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
          <div class="card card-rounded">
            <div class="card-body">
              <form class="forms-sample" action='{{url("admin/newuser")}}' method='post' enctype="multipart/form-data">
                {{ csrf_field()}}
                <div class="form-group">
                  <label for="exampleInputUsername1">Name</label>
                  <input type="text" class="form-control" id="name" name='name' placeholder="Username">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">key</label>
                  <input type="email" class="form-control" id="email" name='email' placeholder="Email">
                </div>
                <button type="submit" class="btn btn-primary me-2">Next</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>