<head>
    <title>ALMM | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('public/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">

    <link href="{{asset('public/backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
    <script src="{{asset('public/backend/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/backend/css/animations.css')}}" />
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-icons.css')}}" />

    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    @stack('backend-css')
</head>
