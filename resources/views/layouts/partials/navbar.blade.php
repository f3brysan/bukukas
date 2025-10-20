<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="mdi mdi-menu mdi-24px"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item navbar-search-wrapper mb-0">
        <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
          <i class="mdi mdi-magnify mdi-24px scaleX-n1-rtl"></i>
          <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
        </a>
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Language -->
      <li class="nav-item dropdown-language dropdown me-1 me-xl-0">
        <a
          class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <i class="mdi mdi-translate mdi-24px"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-language="en">
              <span class="align-middle">English</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-language="id">
              <span class="align-middle">Indonesian</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ Language -->

      <!-- Style Switcher -->
      <li class="nav-item me-1 me-xl-0">
        <a
          class="nav-link btn btn-text-secondary rounded-pill btn-icon style-switcher-toggle hide-arrow"
          href="javascript:void(0);">
          <i class="mdi mdi-24px"></i>
        </a>
      </li>
      <!--/ Style Switcher -->

      <!-- Quick links  -->
      <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-1 me-xl-0">
        <a
          class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
          href="javascript:void(0);"
          data-bs-toggle="dropdown"
          data-bs-auto-close="outside"
          aria-expanded="false">
          <i class="mdi mdi-view-grid-plus-outline mdi-24px"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end py-0">
          <div class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
              <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
              <a
                href="javascript:void(0)"
                class="dropdown-shortcuts-add text-muted"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Add shortcuts"
                ><i class="mdi mdi-view-grid-plus-outline mdi-24px"></i
              ></a>
            </div>
          </div>
          <div class="dropdown-shortcuts-list scrollable-container">
            <div class="row row-bordered overflow-visible g-0">
              <div class="dropdown-shortcuts-item col">
                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                  <i class="mdi mdi-cash-plus fs-4"></i>
                </span>
                <a href="#" class="stretched-link">Add Income</a>
                <small class="text-muted mb-0">Record Income</small>
              </div>
              <div class="dropdown-shortcuts-item col">
                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                  <i class="mdi mdi-cash-minus fs-4"></i>
                </span>
                <a href="#" class="stretched-link">Add Expense</a>
                <small class="text-muted mb-0">Record Expense</small>
              </div>
            </div>
            <div class="row row-bordered overflow-visible g-0">
              <div class="dropdown-shortcuts-item col">
                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                  <i class="mdi mdi-chart-line fs-4"></i>
                </span>
                <a href="#" class="stretched-link">Reports</a>
                <small class="text-muted mb-0">View Reports</small>
              </div>
              <div class="dropdown-shortcuts-item col">
                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                  <i class="mdi mdi-cog-outline fs-4"></i>
                </span>
                <a href="#" class="stretched-link">Settings</a>
                <small class="text-muted mb-0">Account Settings</small>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- Quick links -->

      <!-- Notification -->
      <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2 me-xl-1">
        <a
          class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
          href="javascript:void(0);"
          data-bs-toggle="dropdown"
          data-bs-auto-close="outside"
          aria-expanded="false">
          <i class="mdi mdi-bell-outline mdi-24px"></i>
          <span
            class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end py-0">
          <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
              <h6 class="mb-0 me-auto">Notification</h6>
              <span class="badge rounded-pill bg-label-primary">3 New</span>
            </div>
          </li>
          <li class="dropdown-notifications-list scrollable-container">
            <ul class="list-group list-group-flush">
              <li class="list-group-item list-group-item-action dropdown-notifications-item">
                <div class="d-flex gap-2">
                  <div class="flex-shrink-0">
                    <div class="avatar me-1">
                      <div class="avatar-initial bg-label-success rounded-circle">
                        <i class="mdi mdi-cash-plus mdi-24px"></i>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-200">
                    <h6 class="mb-1 text-truncate">Income Recorded</h6>
                    <small class="text-truncate text-body">New income transaction added</small>
                  </div>
                  <div class="flex-shrink-0 dropdown-notifications-actions">
                    <small class="text-muted">2h ago</small>
                  </div>
                </div>
              </li>
              <li class="list-group-item list-group-item-action dropdown-notifications-item">
                <div class="d-flex gap-2">
                  <div class="flex-shrink-0">
                    <div class="avatar me-1">
                      <div class="avatar-initial bg-label-warning rounded-circle">
                        <i class="mdi mdi-cash-minus mdi-24px"></i>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-200">
                    <h6 class="mb-1 text-truncate">Expense Recorded</h6>
                    <small class="text-truncate text-body">New expense transaction added</small>
                  </div>
                  <div class="flex-shrink-0 dropdown-notifications-actions">
                    <small class="text-muted">4h ago</small>
                  </div>
                </div>
              </li>
              <li class="list-group-item list-group-item-action dropdown-notifications-item">
                <div class="d-flex gap-2">
                  <div class="flex-shrink-0">
                    <div class="avatar me-1">
                      <div class="avatar-initial bg-label-info rounded-circle">
                        <i class="mdi mdi-chart-line mdi-24px"></i>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex flex-column flex-grow-1 overflow-hidden w-px-200">
                    <h6 class="mb-1 text-truncate">Monthly Report Ready</h6>
                    <small class="text-truncate text-body">Your monthly financial report is ready</small>
                  </div>
                  <div class="flex-shrink-0 dropdown-notifications-actions">
                    <small class="text-muted">1d ago</small>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <li class="dropdown-menu-footer border-top">
            <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center text-primary p-2 h-upgrade">
              View all notifications
            </a>
          </li>
        </ul>
      </li>
      <!--/ Notification -->

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
          class="nav-link dropdown-toggle hide-arrow p-0"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('assets') }}/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
          <li>
            <a class="dropdown-item pb-2 mb-1" href="#">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2 pe-1">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('assets') }}/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h6>
                  <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1"></div>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="mdi mdi-account-outline me-2 mdi-20px"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="mdi mdi-cog-outline me-2 mdi-20px"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="mdi mdi-logout me-2 mdi-20px"></i>
              <span class="align-middle">Log Out</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>
