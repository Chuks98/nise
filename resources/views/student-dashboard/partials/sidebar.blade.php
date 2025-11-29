<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between mt-2">
      <a href="/" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="site-logo">
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-6"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
          <span class="hide-menu">Student</span>
        </li>
        
        <!-- Check Student's Result -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="/student-dashboard/check-result" aria-expanded="false">
            <i class="ti ti-search"></i>
            <span class="hide-menu">Check Result</span>
          </a>
        </li>


        <li>
          <span class="sidebar-divider lg"></span>
        </li>
        
        <li class="nav-small-cap">
          <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
          <span class="hide-menu">Account</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link justify-content-between" href="/student-dashboard/edit-student" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
              <span class="d-flex">
                <i class="ti ti-user"></i>
              </span>
              <span class="hide-menu">Edit Account</span>
            </div>  
          </a>
        </li>

        <!-- Change Password -->
        <li class="sidebar-item">
          <a class="sidebar-link justify-content-between" href="/student-dashboard/change-password" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
              <span class="d-flex">
                <i class="ti ti-key"></i>
              </span>
              <span class="hide-menu">Change Password</span>
            </div>  
          </a>
        </li>

        <!-- Logout -->
        <li class="sidebar-item">
          <a class="sidebar-link justify-content-between logout-btn" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
              <span class="d-flex">
                <i class="ti ti-logout"></i>
              </span>
              <span class="hide-menu">Logout</span>
            </div>  
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
