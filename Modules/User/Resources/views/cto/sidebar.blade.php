<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav head-side">
          <li class="nav-item active">
            <a class="nav-link" href='{{url("dashboard")}}'>
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item nav-category"><i class="fas fa-user"></i> Users</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">User List</span>
              <i class="menu-arrow1 fas fa-chevron-down"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu side-submenu">
                <li class="nav-item"> 
                  <a class="nav-link" href='{{url("cto/user")}}'>New User</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href='{{url("cto/userlist")}}''>User List</a></li>
                <li class="nav-item"> <a class="nav-link" href='{{url("cto/teamleader")}}''>Team Leader</a></li>
                <li class="nav-item"> <a class="nav-link" href='{{url("cto/employeelist")}}''>Employee List</a></li>
                <li class="nav-item"> <a class="nav-link" href='{{url("cto/managerlist")}}''>Manager List</a></li>
                <li class="nav-item"> <a class="nav-link" href='{{url("cto/hrlist")}}''>HR List</a></li>
                
              </ul>
            </div>
          </li>

          
          <li class="nav-item nav-category">Project</li>
         
           <li class="nav-item active">
            <a class="nav-link" href='{{url("cto/project/information")}}'>
              <i class="mdi mdi-grid-large menu-icon" ></i>
              <span class="menu-title">Project List</span>
            </a>
          </li>   
       
   

         <li class="nav-item nav-category">Role</li> 
         
         <li class="nav-item active">
          <a class="nav-link" href='{{url("cto/role")}}'>
            <i class="mdi mdi-grid-large menu-icon" ></i>
            <span class="menu-title">All Role</span>   
          </a>

         </li>      

        </ul>
      </nav>  