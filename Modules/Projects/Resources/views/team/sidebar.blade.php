<nav class="sidebar sidebar-offcanvas" id="sidebar">
  @if($single_project != 'single_project')
    <ul class="nav">
      <li class="nav-item active">
        <a class="nav-link" href='#'>
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href='{{url("admin/project/team/backlog/{$project_id}")}}'>
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Backlog</span>
        </a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href='#'>
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Active Sprints</span>
        </a>
      </li>
    </ul>
  @else
    <ul class="nav">
      <li class="nav-item active">
        <a class="nav-link" href='#'>
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard 1</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href='{{url("admin/project/team/backlog/{$project_id}")}}'>
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Backlog 1</span>
        </a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href='#'>
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Active Sprints 1</span>
        </a>
      </li>
    </ul>
  @endif
</nav>