<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title') - {{ __('admin.Dashboard') }}</title>
    @include('layouts.head-assets')

</head>

<body id="page-top">
    @include('layouts.sidebar')

    @yield('page-content')

    @include('layouts.footer')

    @include('layouts.footer-assets')

</body>

</html>
