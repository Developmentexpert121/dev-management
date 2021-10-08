@include('user::admin.header')

<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row"> 
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-center my-3 pb-3">Add Category</h4>
         
              <form class="row align-items-center" action='<?php echo url("admin/editdata/category/".$id) ?>' method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
               
                 <div class="row">   
                    <div class="col-6">
                      <div class="form-outline">
                        <label>Name</label>
                        <input type="text" id="form1" name="name" class="form-control" placeholder="Enter a sprint here" value="<?php echo $category_edit_val['name'] ?>"/>
                      </div>
                      @if($errors->has('name'))
                      <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                      <br>
                  
                    </div>

                    <div class="col-6">
                    <div class="form-outline">
                      <textarea class="form-control"  name="description" rows="4" cols="50" placeholder="Sprint Goal"><?php echo $category_edit_val['description'] ?></textarea>
                    </div>
                    @if($errors->has('description'))
                      <div class="error">{{ $errors->first('description') }}</div>
                      @endif
                    </div>
                </div>


                <div class="row">
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary">Edit</button>
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
  
</div>
<style type="text/css">
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
</style>
@include('projects::admin.footer')
<script type="text/javascript">
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();
  if(month < 10){
    month = '0' + month.toString();
  }
  if(day < 10){
    day = '0' + day.toString();
  }
  var maxDate = year + '-' + month + '-' + day;
  $('.startDate').attr('min', maxDate);
  $('.endDate').attr('min', maxDate);
</script>