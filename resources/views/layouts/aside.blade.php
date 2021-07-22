<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark toggled" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('logo.svg') }}" style="width: 70px; height: 70px" alt="" />
    </div>
    <div class="sidebar-brand-text mx-3">Foto Tobares</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" />

  <!-- Nav Item - Dashboard -->
  <div class="d-flex justify-content-between">
    <div>
      <li class="{{ Route::currentRouteName() ==  'home' ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-home"></i>
          <span>Inicio</span></a>
      </li>

      <li class="{{ Str::contains(Route::currentRouteName(),  'sales') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-dollar-sign"></i>
          <span>Ventas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a href="{{ route('sales.index') }}" class="collapse-item">
              Ver ventas
            </a>
            <a href="{{ route('sales.create') }}" class="collapse-item">
              Vender
            </a>
          </div>
        </div>
      </li>

      <li class="{{ Route::currentRouteName() ==  'map' ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('map.index') }}">
          <i class="fas fa-map"></i>
          <span>Mapa</span></a>
      </li>
    </div>
  </div>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->