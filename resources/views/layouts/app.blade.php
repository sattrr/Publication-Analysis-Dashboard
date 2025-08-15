<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>UM Publication</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }}">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('layouts.navbars.auth.sidenav')

    <main class="main-content position-relative border-radius-lg ps">
        @yield('content')
    </main>

    @include('components.fixed-plugin')

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
        }
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    @stack('js')
</body>

</html>