<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cornelia Connelly College Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard-assets/images/logo.JPEG') }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/styles.min.css') }}" />

    <!-- For CSRF protection in AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
        data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- The header -->
         @include('index.partials.header')
        
        
        <div class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex flex-column justify-content-center align-items-center">

            <!-- Login Form -->
            <div class="d-flex align-items-center justify-content-center w-100 flex-grow-1"style="margin: 200px 0px;">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card shadow mb-0">
                            <div class="card-body">
                                <h4 class="text-center mb-5">ADMIN LOGIN</h4>
                                
                                <form id="loginForm" method="POST" action="{{ route('admin.login') }}">
                                    @csrf

                                    <!-- Username Input -->
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="ti ti-user text-black"></i></span>
                                            <input type="text" class="form-control text-black" id="username" name="username" placeholder="Enter your username" required>
                                        </div>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="ti ti-lock text-black"></i></span>
                                            <input type="password" class="form-control text-black" id="password" name="password" placeholder="Enter your password" required>
                                            <span class="input-group-text bg-light toggle-password" data-target="#password">
                                                <i class="ti ti-eye text-black"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100 py-3 fs-5 mb-3 rounded-2">Login</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- The footer -->
    @include('index.partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('dashboard-assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/app.min.js') }}"></script>
    <!-- Solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
