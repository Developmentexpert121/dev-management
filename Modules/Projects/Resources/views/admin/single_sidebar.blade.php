<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Main Pages -->
    <li class="nav-item active">
      <a class="nav-link" href='{{url("dashboard")}}'>
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title"><i class="fa fa-arrow-left"></i>&nbsp;Back</span>
      </a>
    </li>
    <!--<li class="nav-item nav-category"><h4 class="st_color"><?php // echo $project_data->name ?></h4></li>-->
    <li class="nav-item nav-category"><h4 class="st_color"></h4></li>
    <li class="nav-item">

      <a class="nav-link" data-bs-toggle="collapse" href="#settings_tabs" aria-expanded="false" aria-controls="settings_tabs">
        <i class="fa fa-gear"></i>&nbsp;
        <span class="menu-title">Project setting</span>&nbsp;
        <i class="fa fa-chevron-circle-down"></i>
      </a>
      <!-- Settings Sub Pages Area -->
      <div class="collapse" id="settings_tabs">
        <ul class="nav flex-column">
          <li class=""> <a class="nav-link" href='{{url("admin/project/team/$project_id/settings")}}'><i class="fa fa-info-circle"></i>&nbsp; Details</a></li>
          <li class=""> <a class="nav-link" href='{{url("admin/project/team/$project_id/access")}}'><i class="fa fa-info-circle"></i>&nbsp; Access</a></li>
          <li class=""> <a class="nav-link" href='{{url("admin/project/team/$project_id/issues")}}'><i class="fa fa-info-circle"></i>&nbsp; Issue Types</a></li>
        </ul>
      </div>
      <!-- Settings Sub Pages Area -->

      <a class="nav-link" href='{{url("admin/project/team/$project_id/sprints")}}'>
        <i class="fa fa-print"></i>&nbsp;
        <span class="menu-title">Sprints</span>
      </a>

      <a class="nav-link" href='{{url("admin/project/team/$project_id/roadmap")}}'>
        <i class="fa fa-map"></i>&nbsp;
        <span class="menu-title">Create Issue</span>
      </a>

      <a class="nav-link" href='{{url("admin/project/team/$project_id/backlog")}}'>
        <i class="fa fa-bars"></i>&nbsp;
        <span class="menu-title">Backlog</span>
      </a>

      <a class="nav-link" href='{{url("admin/project/team/$project_id/board")}}'>
        <i class="fa fa-bars"></i>&nbsp;
        <span class="menu-title">Board</span>   
      </a> 

     

    </li>
    <!-- <li class="nav-item nav-category">Project</li>
     <li class="nav-item active">
      <a class="nav-link" href='{{url("admin/project/information")}}'>
        <i class="mdi mdi-grid-large menu-icon" ></i> 
        <span class="menu-title">Software development</span>
      </a>
    </li> -->
  </ul>
</nav>
<style type="text/css">
  .st_color { color: #1F3BB3; }
  .sidebar .nav .nav-item .nav-link i { color: #1F3BB3 !important; }
  .sidebar .nav .nav-item .nav-link { display: flex; align-items: center; white-space: nowrap; padding: 10px 35px 10px 35px; color: #484848; border-radius: 0px 20px 20px 0px; transition-duration: 0.45s; -webkit-transition-property: color; font-weight: 500;   font-size: 14px; color: #1F3BB3 !important; }
  .sidebar .nav { margin-bottom: 0px; }
  ul.flex-column li { margin-left: 20px; }
</style>