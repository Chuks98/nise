<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cornelia Connelly College - Student Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard-assets/images/logo.JPEG') }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/styles.min.css') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
         data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <!-- HEADER -->
        @include('index.partials.header')

        <!-- MAIN LOGIN AREA -->
        <div class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex flex-column justify-content-center align-items-center" style="padding-top: 200px;">

            <div class="container mt-4" style="margin: 200px 0px;">
                <div class="row justify-content-center">
                    <div class="col-lg-6">

                        <div class="card shadow">
                            <div class="card-header bg-secondary">
                                <h5 class="mb-0 text-white">Student Login</h5>
                            </div>

                            <div class="card-body">
                                <form id="studentLoginForm">
                                    @csrf

                                    <div class="row g-3">

                                        <!-- Email -->
                                        <div class="col-12">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-mail"></i></span>
                                                <input type="email" class="form-control text-black" id="email" name="email" placeholder="Enter your email" required>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-lock"></i></span>
                                                <input type="password" class="form-control text-black" id="password" name="password" placeholder="Enter your password" required>

                                                <!-- Toggle -->
                                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                    <i class="ti ti-eye"></i>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-end gap-2">
                                            <button type="reset" class="btn btn-secondary">
                                                <i class="ti ti-x"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ti ti-login"></i> Login
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    @include('index.partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('dashboard-assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/app.min.js') }}"></script>

    <!-- Solar Icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <script>
        // Password toggle
        document.getElementById("togglePassword").addEventListener("click", function () {
            const input = document.getElementById("password");
            const icon = this.querySelector("i");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("ti-eye", "ti-eye-off");
            } else {
                input.type = "password";
                icon.classList.replace("ti-eye-off", "ti-eye");
            }
        });
    </script>

</body>
</html>
