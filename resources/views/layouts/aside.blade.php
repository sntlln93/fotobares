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

      @can('deliver')
      <li class="{{ Str::contains(Route::currentRouteName(), 'deliveries.index') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('deliveries.index') }}">
          <i class="fas fa-box"></i>
          <span>Entregar</span></a>
      </li>
      @endcan

      @can('collect')
      <li class="{{ Str::contains(Route::currentRouteName(), 'payments.index') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('payments.index') }}">
          <i class="fas fa-hand-holding-usd"></i>
          <span>Cobrar</span></a>
      </li>
      @endcan

      <li class="{{ Str::contains(Route::currentRouteName(),  'sales') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-dollar-sign"></i>
          <span>Ventas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            @can('see-sales')
            <a href="{{ route('sales.index') }}" class="collapse-item">
              Ver ventas
            </a>
            @endcan
            <a href="{{ route('sales.create') }}" class="collapse-item">
              Vender
            </a>
          </div>
        </div>
      </li>

      <li class="{{ Str::contains(Route::currentRouteName(), 'presale') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('presale.index') }}">
          <i class="fas fa-users"></i>
          <span>Preventas</span></a>
      </li>

      <li class="{{ Str::contains(Route::currentRouteName(), 'clients') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('clients.index') }}">
          <i class="fas fa-user-friends"></i>
          <span>Clientes</span></a>
      </li>

      <li class="{{ Str::contains(Route::currentRouteName(), 'map') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('map.index') }}">
          <i class="fas fa-map"></i>
          <span>Mapa</span></a>
      </li>

      @can('see-employees')
      <li class="{{ Str::contains(Route::currentRouteName(), 'employees') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('employees.index') }}">
          <i class="fas fa-user"></i>
          <span>Empleados</span></a>
      </li>
      @endcan

      @can('manufacture')
      <li class="{{ Str::contains(Route::currentRouteName(), 'manufacture') ? 'nav-item active' : 'nav-item'  }}">
        <a class="nav-link" href="{{ route('manufacture.index') }}">
          <i class="fas fa-tools"></i>
          <span>Fabricación</span></a>
      </li>
      @endcan
    </div>
  </div>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->