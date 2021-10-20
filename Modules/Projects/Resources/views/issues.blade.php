@include('projects::admin.header')
<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">Issues Types</h4>
              <form class=" align-items-center" action='{{url("projects/team/project/issueadd")}}' method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type='hidden' name='project_id' value='{{$project_id}}'/>
                <div class="row">
                  <div class="col-8">
                    <div class="form-outline">
                      <input type="text" id="form1" name="new_issue" class="form-control" placeholder="Enter a issue here" />
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-8">
                    <div class="form-outline">
                      <input type="text" id="form1" name="summary" class="form-control" placeholder="Enter a summary here" />
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-8">
                    <div class="form-outline">
                      <textarea name="issuedescription" class="form-control" placeholder="Description"></textarea>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
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
  <div class="row" style="width: 100%;">
    <?php if(!empty($issues)){ ?>
      <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Sr. No</th>
              <th>Task</th>
              <th>Summary</th>
              <th>Description</th>
              <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            foreach($issues as $data){
                ?>
                <tr> 
                    <td><?php echo $i++  ?></td> 
                    <td><?php echo ucfirst($data->issue_type);  ?></td>
                    <td><?php echo ucfirst($data->summary) ; ?></td>
                    <td><?php echo ucfirst($data->description) ; ?></td>
                    <!-- <td>
                      <select>
                        <option value="in-progress">Edit</option>
                        <option value="to-do">Delete</option>
                      </select>
                    </td> -->
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
              <th>Sr. No</th>
              <th>Task</th>
              <th>Summary</th>
              <th>Description</th>
              <!-- <th>Action</th> -->
            </tr>
        </tfoot>
      </table>
    <?php } ?>
  </div>
</div>
<style type="text/css">
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
  .form-control { border: 1px solid #dee2e6 !important; }
</style>
@include('projects::admin.footer')