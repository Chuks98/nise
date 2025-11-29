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
        
        
        <div class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex flex-column justify-content-center align-items-center" style="padding-top: 200px;>
    
    
            <!-- Student Registration Form -->
            <div class="container mt-4" style="margin: 200px 0px;">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow">
                            <div class="card-header bg-secondary">
                                <h5 class="mb-0 text-white">Student Registration</h5>
                            </div>

                            <div class="card-body">
                                <form id="studentRegisterForm">
                                    @csrf

                                    <div class="row g-3">

                                        <!-- Full Name -->
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-user"></i></span>
                                                <input type="text" class="form-control" id="fullName" name="name" placeholder="Enter full name" required>
                                            </div>
                                        </div>

                                        <!-- Reg No -->
                                        <div class="col-md-6">
                                            <label class="form-label">Reg No <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-id"></i></span>
                                                <input type="text" class="form-control" id="regNo" name="reg_no" placeholder="Registration number" required>
                                            </div>
                                        </div>

                                        <!-- Username -->
                                        <div class="col-md-6">
                                            <label class="form-label">Username <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-user-circle"></i></span>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-mail"></i></span>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-lock"></i></span>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>

                                                <!-- Toggle Button -->
                                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                    <i class="ti ti-eye"></i>
                                                </span>
                                            </div>
                                            <small id="passwordStrength" class="mt-1 d-block"></small>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="ti ti-lock"></i></span>
                                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Re-enter password" required>

                                                <!-- Toggle Button -->
                                                <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                                    <i class="ti ti-eye"></i>
                                                </span>
                                            </div>
                                            <small id="passwordMatch" class="mt-1 d-block"></small>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-end gap-2">
                                            <button type="reset" class="btn btn-secondary">
                                                <i class="ti ti-x"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ti ti-check"></i> Register Student
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

