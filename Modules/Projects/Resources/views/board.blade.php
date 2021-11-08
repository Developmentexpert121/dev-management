@include('projects::admin.header')


<link rel="stylesheet"
    href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style>
 
body {
    font-family: arial;
}
.task-board {

    display: inline-block;
    padding: 12px;
    border-radius: 3px;
    weight:100%;

 
   
}

.status-card {
    width: 250px;
    margin-right: 8px;
    background: #e2e4e6;
    border-radius: 3px;
    display: inline-block;
    vertical-align: top;
    font-size: 0.9em;
}

.status-card:last-child {
    margin-right: 0px;
}

.card-header {
    width: 100%;
    padding: 10px 10px 0px 10px;
    box-sizing: border-box;
    border-radius: 3px;
    display: block;
    font-weight: bold;
}

.card-header-text {
    display: block;
}

ul.sortable {
    padding-bottom: 10px;
}

ul.sortable li:last-child {
    margin-bottom: 0px;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0px;
}

.text-row {
    padding: 15px 10px;
    margin: 10px;
    background: #fff;
    box-sizing: border-box;
    border-radius: 3px;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
    font-size: 0.8em;
    white-space: normal;
    line-height: 20px;
}

.ui-sortable-placeholder {
    visibility: inherit !important;
    background: transparent;
    border: #666 2px dashed;
}


</style>
   

  <div class="task-board">
          
           @foreach ($statusResult as $statusRow)
       
              
                <div class="status-card">
                    <div class="card-header">
                        <span class="card-header-text"><?php echo $statusRow->status_name; ?></span>
                    </div>
                    <ul class="sortable ui-sortable"
                        id="sort<?php echo $statusRow->id; ?>"
                        data-status-id="<?php echo $statusRow->id ?>">
               
                  @if(! empty($taskResult)) 
          
                  @foreach ($taskResult as $taskRow)
                       
                      @if($taskRow->issue_status== 0 && $statusRow->id == 1 && ! $taskRow->sprint_start_status) 
                      
                            <li class="text-row ui-sortable-handle" 
                            data-task-id="<?php echo $taskRow->id ?>"><?php echo $taskRow->issue_name; ?></li>
                           
                            @elseif($taskRow->issue_status==1 && $statusRow->id == 2 && ! $taskRow->sprint_start_status)
                             <li class="text-row ui-sortable-handle" 
                            data-task-id="<?php echo $taskRow->id ?>"><?php echo $taskRow->issue_name; ?></li>

                            @elseif($taskRow->issue_status==2 && $statusRow->id == 3  && ! $taskRow->sprint_start_status)
                             <li class="text-row ui-sortable-handle" 
                            data-task-id="<?php echo $taskRow->id ?>"><?php echo $taskRow->issue_name; ?></li>
                            @endif
                            
                  @endforeach 
                  @endif 
               
                  </ul>
                </div>
            @endforeach
        </div>
       
              
           
    <script>
 $( function() {
  
     var url = 'boardmove';
     $('ul[id^="sort"]').sortable({

         connectWith: ".sortable",
         receive: function (e, ui) {
            var status_id = $(ui.item).parent(".sortable").data("status-id");
            var task_id = $(ui.item).data("task-id");
    
             $.ajax({   
                 url: url+'?header_id='+status_id+'&issue_id='+task_id,
                 success: function(response){  
                     }
             }); 

             } 
     
     }).disableSelection();
     } ); 

  </script>
