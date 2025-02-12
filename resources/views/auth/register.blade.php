<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>
    <link rel="icon" href="{{ asset('assets/img/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        .form-control {
            height: 35px;
            font-size: 14px;
        }
        
        .error {
            color: red;
            font-size: 12px;
            font-weight: bold;
            margin-left: 5px;
        }

        .card {
        width: 400px;
    }

    @media (max-width: 768px) {
        .card {
            width: 90%; 
        }
    }
    </style>
</head>

<body>

    <div class="container-fluid d-flex justify-content-center">
        <div class="row justify-content-center mt-4">
            <div class="card mb-3">
                <div class="card-body py-3">
                    <h3 class="text-center mt-2">Create An Account</h3>
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user mb-2"></i> Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" />
                            <label id="name-error" class="error"></label>
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope mb-2"></i> Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" />
                            <label id="email-error" class="error"></label>
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="fa-solid fa-lock mb-2"></i> Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" />
                                <span class="input-group-text cursor-pointer toggle-password" style="cursor: pointer;">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                            <label id="password-error" class="error"></label>
                        </div>

                        <div class="form-group mt-2">
                            <label for="password_confirmation"><i class="fa-solid fa-lock mb-2"></i> Confirm Password</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password" />
                                <span class="input-group-text cursor-pointer toggle-password" style="cursor: pointer;">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                            <label id="password_confirmation-error" class="error"></label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Create An Account</button>
                        <hr class="mt-3">
                        <div class="text-center"> 
                            <a class="small" href="{{ route('login') }}">Already have an account? Login</a>
                        </div>

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
        $(document).ready(function () {
            $("#registerForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                        alpha: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: "Name is required.",
                        minlength: "Name must be at least 3 characters long.",
                        maxlength: "Name must not exceed 50 characters.",
                        alpha: "Name must contain only alphabetic characters."
                    },
                    email: {
                        required: "Email is required.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Password is required.",
                        minlength: "Password must be at least 8 characters long."
                    },
                    password_confirmation: {
                        required: "Confirm Password is required.",
                        equalTo: "Passwords do not match."
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $.validator.addMethod("alpha", function (value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
            }, "Only alphabetic characters are allowed.");

            $(".toggle-password").click(function () {
                let passwordInput = $(this).siblings("input");
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
