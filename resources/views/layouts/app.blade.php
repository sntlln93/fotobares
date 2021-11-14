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
    .ROSADO {
      background-color: #e069e0 !important;
    }

    .AZUL {
      background-color: #396adb !important;
    }

    .NEGRO {
      background-color: #2a2a2b !important;
    }

    .BLANCO {
      color: #2a2a2b !important;
      border: 1px solid rgba(0, 0, 0, .3);
    }

    .ROSADO-text {
      border-radius: 50%;
      color: #e069e0 !important;
      background-color: #e069e0 !important;
      border: 1px solid rgba(0, 0, 0, .4);
    }

    .AZUL-text {
      border-radius: 50%;
      color: #396adb !important;
      background-color: #396adb !important;
      border: 1px solid rgba(0, 0, 0, .4);
    }

    .NEGRO-text {
      border-radius: 50%;
      color: #2a2a2b !important;
      background-color: #2a2a2b !important;
      border: 1px solid rgba(0, 0, 0, .4);
    }

    .BLANCO-text {
      border-radius: 50%;
      color: #fafafa !important;
      background-color: #fafafa !important;
      border: 1px solid rgba(0, 0, 0, .4);
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

  @yield('scripts')

</body>

</html>