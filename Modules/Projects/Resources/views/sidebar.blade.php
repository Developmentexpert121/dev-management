<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href='{{url("dashboard")}}'>
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item nav-category">Users</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic13" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">User List</span>
              <i class="menu-arrow"></i> 
            </a>

            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href='{{url("admin/user")}}'>New User</a></li>
                <li class="nav-item"> <a class="nav-link" href='{{url("admin/userlist")}}'>User List</a></li>
              </ul>
            </div>
          </li>


          <li class="nav-item nav-category">Project</li>
         
           <li class="nav-item active">
            <a class="nav-link" href='{{url("admin/project/template")}}'>
              <i class="mdi mdi-grid-large menu-icon" ></i>
              <span class="menu-title">Software development</span>
            </a>
          </li> 

          
         
        </ul>
      </nav>