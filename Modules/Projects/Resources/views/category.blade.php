@include('user::admin.header')
<div class="container">
  <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <h4 class="text-left my-3 pb-3">Add Category</h4> 
         
              <form class="row align-items-center" action='{{url("admin/save/category")}}' method='post'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
               
                 <div class="row">
                    <div class="col-12">
                      <div class="form-outline category_name">
                        <label>Name</label>
                        <input type="text" id="form1" name="name" class="form-control w-75" placeholder="Enter a Category here" value="{{old('name')}}"/>
                      </div>
                      @if($errors->has('name'))
                      <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                      <br> 
                    </div>

                    <div class="col-12">
                    <div class="form-outline">

                    <label>Description</label>
                      <textarea class="form-control w-75 mb-3"  name="description" rows="4" cols="50" placeholder="Enter a description here">{{old('description')}}</textarea>
                    </div>

                    @if($errors->has('description'))
                      <div class="error">{{ $errors->first('description') }}</div>
                      @endif
                    </div>
                </div>

          
    
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

  @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif




    <?php if(!empty($category)){ ?>
      <table id="projects_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
          <tr>
              <th>Sr.No1</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
              $i=1;
              foreach($category as $data){
                ?>
                <tr> 
                    <td>{{$i++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->description}}</td>
                    <td>

                    <a href="<?php echo url('admin/edit/category/'.$data->id) ?>"><i class="fa fa-pencil" title="Edit"></i></a>
                   &nbsp;&nbsp;

                   <a href="<?php echo url('admin/delete/category/'.$data->id) ?> " onclick="return confirm('Are you sure you want delete ?')"><i class="fa fa-trash-o fa-lg"></i></a> 
                  
                </td>
                </tr>  
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
           
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