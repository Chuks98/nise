<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-center py-3">
                    <h4 class="mb-0 text-white">Edit Student Account</h4>
                </div>

                <div class="card-body p-4">
                    <form id="editStudentForm">
                        @csrf

                        <!-- FULL NAME -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit_fullName" name="name" class="form-control"
                                       placeholder="Enter full name" required>
                            </div>
                        </div>

                        <!-- REG NO -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Registration Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-id"></i></span>
                                <input type="text" id="edit_regNo" name="reg_no" class="form-control"
                                       placeholder="Enter Reg No" required>
                            </div>
                        </div>

                        <!-- USERNAME -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-user-circle"></i></span>
                                <input type="text" id="edit_username" name="username" class="form-control"
                                       placeholder="Enter username" required>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ti ti-mail"></i></span>
                                <input type="email" id="edit_email" name="email" class="form-control"
                                       placeholder="Enter email" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-device-floppy"></i> Update Account
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
