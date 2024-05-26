<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <!-- As a link -->
    @include('layouts.inc_tamu.navbar')

    <div class="container-fluid p-0">
        <div class="pesan">
            <img src="image/hotel.jpg" class="img img-fluid w-100">
        </div>
        <div class="container">
            @yield('content')
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <span class="text-muted"><strong>Copyright &copy; 2024 Muhammad Erlangga Putra W</strong> All rights
                    reserved.</span>
            </div>
        </footer>

        <!-- jQuery -->
        <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/adminlte/dist/js/adminlte.min.js"></script>

</body>

</html>