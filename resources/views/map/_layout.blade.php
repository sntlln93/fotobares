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
        button>i,
        a>i {
            pointer-events: none;
        }

        /* should remove this style */
        .border--transparent {
            --color-border: rgba(0, 0, 0, .3);
            border: 1px solid var(--color-border) !important;
        }

        /* should remove this style */
        .color-indicator {
            border: 2px solid rgba(0, 0, 0, 0.3);
            border-radius: 50%;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .client {
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .client__info {
            padding: 2em 1em;
            border-radius: 20px 20px 0;
            background: var(--white);
            box-shadow: 0 0 2px 2px rgba(78, 115, 223, 0.25);
        }

        .client__header {
            display: flex;
            justify-content: flex-end;
            gap: .3em;
            margin-bottom: 1em;
        }

        .client__content {
            margin-bottom: 1em;
        }

        .client__content>p {
            margin-bottom: 0;
        }

        .client__house {
            margin: 0 auto;
            width: 150px;
            height: auto;
        }

        .client__house img {
            width: 100%;
            object-fit: contain;
        }

        .client__close {
            background-color: var(--white);
            border-radius: 50%;
            box-shadow: 0 0 2px 2px rgba(78, 115, 223, 0.25);
            color: var(--red);

            position: absolute;
            top: 0;
            left: 50vw;
            transform: translate(-50%, -50%);
        }

        .client__close:hover {
            background-color: var(--red);
            color: var(--white);
            border: 0;
        }

        .client__header [data-remove] {
            --color-border: var(--red);
            background: var(--white);
            color: var(--red);
        }

        .client__header [data-remove]:hover {
            background: var(--red);
            color: var(--white);
        }
    </style>
</head>

<body>

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
                @include('layouts.header', ['margin' => '0'])
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    <script>
        const BASE_URL = "{{ env('APP_URL') }}";
    const routes = {
        client:'{{ route('clients.show', ['client' => ':client']) }}',
        whatsapp:'{{ route('whatsapp.send', ['phone' => ':phone']) }}',
        images: '{{ asset('storage/'. ':path') }}',
        map: '{{ route('map.show', ['client' => ':client']) }}',
        sales: {
            show: "{{ route('sales.show', ['sale' => ':sale']) }}",
            collect: '{{ route('collect', ['sale' => ':sale']) }}',
            recalculate: "{{ route('recalculate.form', ['sale' => ':sale']) }}",
        },
    };
    </script>
    @yield('scripts')

</body>

</html>