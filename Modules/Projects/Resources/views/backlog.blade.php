@include('projects::admin.header')
<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div backlog">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">Backlog</h4>
              <form class="row align-items-center" action='{{url("projects/team/project/add_task")}}' method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type='hidden' name='project_id' value=''/>
                <div class="col-8">
                  <div class="form-outline">
                    <button>create sprint</button>
                    </div>
                </div>
                <!-- <div class="col-2">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
                <!-- <div class="col-2">
                  <button type="submit" class="btn btn-warning">Get tasks</button>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<style type="text/css">
  .custom_div { padding-top: 7rem !important; }
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
  .backlog {padding-top: 0rem !important;}
</style>
@include('projects::admin.footer')