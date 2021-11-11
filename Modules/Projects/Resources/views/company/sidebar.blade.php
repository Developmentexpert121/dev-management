<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item dasboard active">
            <a class="nav-link" href='{{url("/admin/dashbaord")}}'>
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Back To Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item active">
           <a class="nav-link" href='{{url("/projects/company/$project_id/sprints")}}'>
        <i class="fa fa-print"></i>&nbsp;
        <span class="menu-title">Sprints</span>
      </a>
         </li>
         <li class="nav-item active">
           <a class="nav-link" href='{{url("projects/company/$project_id/createissue")}}'>
        <i class="fa fa-map"></i>&nbsp;
        <span class="menu-title">Create Issue</span>
      </a>

         </li>
         <li class="nav-item active">
            <a class="nav-link" href='{{url("/projects/company/$project_id/board")}}'>
              <i class="mdi mdi-grid-large"></i>
              <span class="menu-title">Active Sprints</span>
            </a>
          </li>
         <li class="nav-item active">
           <a class="nav-link" href='{{url("/projects/company/$project_id/backlog")}}'>
        <i class="fa fa-bars"></i>&nbsp;
        <span class="menu-title">Backlog</span>
      </a>

         </li>
      <li class="nav-item active">
       <a class="nav-link" data-bs-toggle="collapse" href="#settings_tabs" aria-expanded="false" aria-controls="settings_tabs">
        <i class="fa fa-gear"></i>&nbsp;
        <span class="menu-title">Project setting</span>&nbsp;
        <i class="fa fa-chevron-circle-down"></i>
      </a>
</li>
      <!-- Settings Sub Pages Area -->
      <div class="collapse" id="settings_tabs">
        <ul class="nav flex-column">
          <li class="nav-item active"> <a class="nav-link" href='{{url("projects/company/$project_id/settings")}}'><i class="fa fa-info-circle"></i>&nbsp; Details</a></li>
          <li class="nav-item active"> <a class="nav-link" href='{{url("admin/project/team/$project_id/access")}}'><i class="fa fa-info-circle"></i>&nbsp; Access</a></li>
          <li class="nav-item active"> <a class="nav-link" href='{{url("admin/project/team/$project_id/issues")}}'><i class="fa fa-info-circle"></i>&nbsp; Issue Types</a></li>
        </ul>
      </div>
        </ul>
      </nav>
      <style>
        .sidebar .nav .nav-item .nav-link {
    display: flex;
    align-items: center;
    white-space: nowrap;
    padding: 10px 35px 10px 35px;
    color: #484848;
    border-radius: 0px 20px 20px 0px;
    transition-duration: 0.45s;
    -webkit-transition-property: color;
    font-weight: 500;
    font-size: 14px;
    color: #1F3BB3 !important;
}
.dasboard {
    margin: 0 0 40px 0px;
}
        </style>