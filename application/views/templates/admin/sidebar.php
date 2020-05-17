<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url() . "admin"; ?>">
    <div class="sidebar-brand-icon">
      <img src="<?php echo base_url() . "assets/images/icons/logo.png"; ?>"/>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
  </a>
  <hr class="sidebar-divider my-0" />
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo site_url() . "/admin"; ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Panel</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="<?php echo site_url(); ?>">
      <i class="fas fa-fw fa-hotel"></i>
      <span>Intractive</span></a>
  </li>
  <hr class="sidebar-divider" />
  <div class="sidebar-heading">
    Manage Hotels
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Manage Hotels</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Hotel Management</h6>
          <a class="collapse-item" href="alerts.html">New Hotel</a>
          <a class="collapse-item" href="buttons.html">Edit Hotel</a>
          <a class="collapse-item" href="dropdowns.html">Delete Hotel</a>
        </div>
      </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span>
    </a>
    <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Tables</h6>
        <a class="collapse-item" href="<?php echo site_url() . "admin/showData"; ?>">All Hotels</a>
        <a class="collapse-item" href="datatables.html">All Rooms</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider" />
</ul>