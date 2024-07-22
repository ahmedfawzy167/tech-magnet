<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>
    <link rel="icon" href="{{asset('assets/img/register.png')}}">
      <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                            </div>
                            <form class="user" action="{{ route('register')}}" method="POST" id="registerForm">
                              @csrf
                              <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Name">
                                </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        name="email" placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Already have an account? Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
         toastr.options = {
        "closeButton": false,
        "debug": false,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "toastClass": "bg-danger text-white"
    }
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
          <script>
              toastr.error('{{ $error }}');
          </script>
        @endforeach

    @endif

    <script>
        $(document).ready(function() {
            $("#registerForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 5,
                        maxlength: 50,
                        alpha: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: "<span style='color:red;font-weight:bold;'>Name is required.</span>",
                        minlength: "<span style='color:red;font-weight:bold;'>Name must be at Least 5 Characters Long.</span>",
                        maxlength: "<span style='color:red;font-weight:bold;'>Name must not Exceed 50 Characters.</span>",
                        alpha: "<span style='color:red;font-weight:bold;'>Name must Contain Only Alphabetic Characters.</span>"
                    },
                    email: {
                        required: "<span style='color:red;font-weight:bold;'>Email is Required.</span>",
                        email: "<span style='color:red;font-weight:bold;'>Please Enter a Valid Email Address.</span>"
                    },
                    password: {
                        required: "<span style='color:red;font-weight:bold;'>Password is required.</span>",
                        minlength: "<span style='color:red;font-weight:bold;'>Password must be at Least 8 Characters long.</span>"
                    },
                    password_confirmation: {
                        required: "<span style='color:red;font-weight:bold;'>Confirm Password is Required.</span>",
                        equalTo: "<span style='color:red;font-weight:bold;'>Passwords do not Match.</span>"
                    }
                },
                errorClass: "is-invalid",
                validClass: "is-valid",
                submitHandler: function(form) {
                    form.submit();
                }
            });
             $.validator.addMethod("alpha", function(value, element) {
              return this.optional(element) || value.match(/^[a-zA-Z\s]+$/);
            }, "Name must contain only alphabetic characters.");
        });
        </script>

</body>

</html>