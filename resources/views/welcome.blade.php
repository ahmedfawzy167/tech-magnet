<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tech Magnet</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.jpg') }}"/>


        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

         <!-- Styles -->
         <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
        integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <img src="{{asset('assets/img/logo.jpg')}}" style="width: 30%">
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('login') }}" class="btn btn-primary w-25">SIGN IN</a>
                </div>

            </div>
        </div>
    </body>
</html>