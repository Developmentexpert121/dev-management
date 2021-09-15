

@include('projects::admin.header')


<div class="main-panel">    
        
        <div class="row" > 
                 <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                           <div class="card card-rounded">
                              <div class="card-body">
                              <a href=''>
                                  <h4 algin='center'>Kanban</h4></a>  

                                <br>
                               </div>
                       </div>
                  </div>
               </div>
             </div>

             <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                           <div class="card card-rounded">

                              <div class="card-body">
                              <a href='{{url("admin/project/scrum/template")}}'> 
                                  <h4  algin='center'>Scrum</h4> 
                               </a>
                              <br>
                              </div>

                       </div>
                  </div>
               </div>
             </div>

             <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                           <div class="card card-rounded">
                              <div class="card-body">
                              <a href=''>
                                  <h4  algin='center'>Bug tracking</h4> 
                               </a>           
                                <br>
                               </div>
                       </div>
                  </div>
               </div>
             </div>
      </div>
</div>


@include('projects::admin.footer')

