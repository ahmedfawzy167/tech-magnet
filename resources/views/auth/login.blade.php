<!-- Section: Design Block -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('assets/img/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
        .rounded-t-5 {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        @media (min-width: 992px) {
            .rounded-tr-lg-0 {
                border-top-right-radius: 0;
            }

            .rounded-bl-lg-5 {
                border-bottom-left-radius: 0.5rem;
            }
        }
    </style>

</head>

<body>

    <div class="container-fluid d-flex justify-content-center">
        <div class="row justify-content-center mt-4">
            <div class="card mb-3">
                <div class="card-body py-3">
                    <h3 class="text-center mt-2">Login to Your Account</h3>
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <div class="form-group mb-2 mt-3">
                            <label for="email"><i class="fa-solid fa-envelope mb-2"></i> Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-control form-control-lg @error('email') is-invalid @enderror" />
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fa-solid fa-lock mb-2"></i> Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password" />
                                <span class="input-group-text cursor-pointer" id="togglePassword" style="cursor: pointer;">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                        </div>
                        

                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
                            <hr class="mt-4">
                            <p class="text-center">Don't have an account?<a href="{{route('register')}}" class="ms-1 text-decoration-none">Register</a></p>

                    </form>

                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}');
            </script>
        @endforeach
    @endif

   
<script>
 $(document).ready(function() {
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
            }
        },
        messages: {
            email: {
                required: "Please Enter your Email Address.",
                email: "Please Enter a Valid Email Address."
            },
            password: {
                required: "Please Enter your Password.",
                minlength: "Password must be at Least 8 Characters Long.",
            }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorElement: "div", 
        errorPlacement: function(error, element) {
            if (element.attr("id") === "password") {
                error.addClass("text-danger mt-1").insertAfter(element.closest(".input-group"));
            } else {
                error.addClass("text-danger mt-1").insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#togglePassword").click(function() {
        let passwordInput = $("#password");
        let icon = $(this).find("i");

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("ti-eye-off").addClass("ti-eye");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("ti-eye").addClass("ti-eye-off");
        }
    });
});

</script>



   
           
</body>

</html>
