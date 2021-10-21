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
                    @if($errors->has('new_issue')) 
                      <div class="error">{{ $errors->first('new_issue') }}</div> 
                      @endif
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-8">
                    <div class="form-outline">
                      <input type="text" id="form1" name="summary" class="form-control" placeholder="Enter a summary here" />
                    </div>

                    @if($errors->has('summary')) 
                      <div class="error">{{ $errors->first('summary') }}</div>
                      @endif

                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-8">
                    <div class="form-outline">
                      <textarea name="description" class="form-control" placeholder="Description"></textarea>
                    </div>
                    @if($errors->has('description'))
                      <div class="error">{{ $errors->first('description') }}</div>
                      @endif
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
              <th>Action</th>
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
                   <td> 
                     <!-- Button trigger modal -->
                     <button type="button"  data-toggle="modal" data-target="#edit{{$data->id}}">
                           <i class="fa fa-pencil" title="Edit"></i>
                      </button> 

                   <a href="<?php echo url('projects/team/issue/delete/'.$data->id) ?>" onclick="return confirm('Are you sure you want delete?')"><i class="fa fa-trash-o fa-lg"></i></a>
                    </td>
                </tr> 

                     <!-- Modal -->
                <div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">Update Issue</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                    <form class="row align-items-center" action='{{url("projects/team/create/issue/update")}}' method='post' >  
                         
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">    
                      <input type='hidden' name='project_id' value='{{$project_id}}'/>  
                      <input type='hidden' name='issue_id' value='{{$data->id}}'/>         
          
                      <div class="row"> 
                          <div class="col-6"> 
                             <div class="form-outline">
                                 <label>Issue Name</label>
                                <input type="text" id="form1" name="name" class="form-control" placeholder="Enter a sprint here" value="{{$data->issue_type}}" />
                             </div>
                                   
                                @if($errors->has('name')) 
                                <div class="error">{{ $errors->first('name') }}</div>
                                @endif     

                                <br>
                          </div>
                      </div>


                          <div class="row">
                              <div class="col-6">
                                <div class="form-outline">
                                  <label>Summary</label>
                                  <input type="text" id="form1" name="eSummary" class="form-control" placeholder="Enter a sprint here" value="{{$data->summary}}" />
                                </div>
                                   
                                @if($errors->has('eSummary')) 
                                <div class="error">{{ $errors->first('eSummary') }}</div>
                                @endif      

                                <br>
                              </div>
                          </div>


                          <div class="row">
                              <div class="col-6">
                              <div class="form-outline">
                              <label>Description</label>
                                 <textarea name="eDescription" class="form-control" placeholder="Description">{{$data->description}}</textarea>
                              </div>
                                   
                                @if($errors->has('eDescription')) 
                                <div class="error">{{ $errors->first('eDescription') }}</div>
                                @endif     

                                <br>
                              </div>
                          </div> 

                          
                       
                          <div class="row">
                            <div class="col-2">
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>

                    </form>   
                            

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                      </div>
                    </div>
                  </div>
                </div>


            <?php } ?>   
        </tbody>
        <tfoot>
            <tr>
              <th>Sr. No</th>
              <th>Task</th>
              <th>Summary</th>
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
  .form-control { border: 1px solid #dee2e6 !important; }
</style>
@include('projects::admin.footer')