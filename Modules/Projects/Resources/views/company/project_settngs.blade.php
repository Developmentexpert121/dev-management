@include('projects::company.header')
<div class="main-panel">    
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body mx-auto ">
            <?php 
                // echo '<pre>';
                // print_r($profiledata);
                // die('test');


            ?>
            <form class="forms-sample" id="project_details" action="{{ route('company.detail',$project_id) }}" method='post' enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{csrf_token() }}">
                <input type='hidden' name='project_id' value='{{$project_id}}'/>
                <!-- <input type='hidden' name='project_type' value='1'/> -->
                <div class="form-group">
                  <label for="exampleInputEmail1">Avatar</label>
                  <div class="row profile_box">
                    <div class="col-md-4 mb-2">
                     <?php if (!empty ($project_data->image)){ ?>

                         <img class="setting_image" id="image_preview_container" alt="{{$project_data->name}}" src="{{ asset('user/images/' . $project_data->image) }}"  alt="preview image" style="max-height: 128px;">
                       <?php }else{ ?> 
                        <img id="image_preview_container"  src="{{asset('user/images/default.png')}}"  alt="preview image" style="max-height: 128px;">

                       <?php } ?> 
                       
                    </div>
                  <!-- <div class="col-md-8">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                        <span class="text-danger">{{ $errors->first('title') }}</span>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                
                </div> -->

            </div> 
                <img class="setting_image" src="" ><br>
                <input type="file" name="image" id="image" Required="required">
                </div>

                <div class="form-group">
                  <label for="exampleInputUsername1">Name</label>
                  <input type="text" class="form-control" id="name" name='name' placeholder="Project Name" value="{{$project_data->name}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Key</label>
                  <input type="text" class="form-control" id="key" name='key' placeholder="key" value="{{$project_data->key}}" >
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Project Category</label>
                  <select class="form-control" name="category">
                @foreach($categorys as $category)
                    <option value="{{$category->name}}">{{$category->name}}</option>
                   @endforeach
                  </select>
                </div>

                <div class="col-12">
                  <div class="form-outline">
                    <label>Description</label>
                    <textarea  id="description" name="description" class="form-control" placeholder="Enter a task here">{{$project_data->Description}}</textarea>
                  </div>
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Project Lead</label>
                  <select class="form-control" name="project_lead">
                    <option value="">Select</option>
                  </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Default Assignee</label>
                  <select class="form-control" name="project_assignee">
                    <option value="">Select</option>
                  </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary me-2" id="form_submit" >Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('projects::company.footer')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor.create( document.querySelector( '#description' ) )
  .then( editor => {
        console.log( editor );
  } )
  .catch( error => {
        console.error( error );
  } );
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
  
   $('#project_details').submit(function(e) {

     e.preventDefault();
  
     var formData = new FormData(this);
  
     $.ajax({
        type:'POST',
        url: "{{ route('company.detail') }}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
           // this.reset();
           alert('Image has been uploaded successfully');
            location.reload();
        },
        error: function(data){
           console.log(data);
         }
       });
   });
});
</script>