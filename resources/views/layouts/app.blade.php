<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Admin panel for versusbet's admins">
  <meta name="author" content="Santillán Matías">

  <title>Foto Tobares - @yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <style>
    .gap-1 {
      gap: .5rem !important;
    }

    .gap-2 {
      gap: 1rem !important;
    }

    .gap-3 {
      gap: 1.5rem !important;
    }

    .gap-4 {
      gap: 2rem !important;
    }

    .gap-5 {
      gap: 2.5rem !important;
    }

    td {
      white-space: nowrap;
    }

    .filter--active {
      background-color: var(--primary);
      color: #FFF;
    }

    .filter--active:hover {
      color: #fff;
      background-color: #2e59d9;
      border-color: #2653d4;
    }

    .fab,
    .fas {
      pointer-events: none;
    }

    .color-picker--row {
      gap: 1rem;
    }

    .color-picker {
      max-width: 35px;
      padding: .2em;
    }

    .border--transparent {
      border: 1px solid rgba(0, 0, 0, .3) !important;
    }

    .color-indicator {
      border: 2px solid rgba(0, 0, 0, 0.3);
      border-radius: 50%;
    }
  </style>
  @yield('styles')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.aside')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('layouts.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
    @if(Session::get('message'))
      Swal.fire({
        icon: "{!! Session::get('message')['type'] !!}",
        text: "{!! Session::get('message')['content'] !!}",
        showConfirmButton: false,
        timer: 3000
      });
    @endif
  </script>

  <script src="{{ asset('js/views/map/map.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
  <script>
    document.addEventListener('click', event => {
      const target = event.target;

      if(target.hasAttribute('data-map-add')){
        addToMap({ target });
      }
    });
  </script>
  @yield('scripts')

</body>

</html>