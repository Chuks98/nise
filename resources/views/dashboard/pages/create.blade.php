<!-- Create Student Record Form -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0 text-white">Create New Student Record</h5>
                </div>
                <div class="card-body">
                    <form id="createStudentForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="serialNumber" class="form-label">Serial Number </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-user"></i></span>
                                    <input type="text" class="form-control" id="serialNumber" name="serialNumber" placeholder="Enter student's Serial Number">
                                </div>
                            </div>
                    
                            <div class="col-md-4">
                                <label for="studentName" class="form-label">Fullname <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-user"></i></span>
                                    <input type="text" class="form-control" id="studentName" name="name" placeholder="Enter student's fullname" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentRegNo" class="form-label">Reg No <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-id"></i></span>
                                    <input type="text" class="form-control" id="studentRegNo" name="reg_no" placeholder="Enter registration number" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentClass" class="form-label">Class <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-school"></i></span>
                                    <input type="text" class="form-control" id="studentClass" name="class" placeholder="Enter class" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentSemester" class="form-label">Semester <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-calendar-event"></i></span>
                                    <input type="text" class="form-control" id="studentSemester" name="semester" placeholder="eg., 1st, 2nd" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentSession" class="form-label">Session <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-calendar-stats"></i></span>
                                    <input type="text" class="form-control" id="studentSession" name="session" placeholder="e.g., 2024/2025" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentTotal" class="form-label">Total <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-sum"></i></span>
                                    <input type="number" class="form-control" id="studentTotal" name="total" placeholder="Enter total score" step="0.01" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentAverage" class="form-label">Average <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-percentage"></i></span>
                                    <input type="number" class="form-control" id="studentAverage" name="average" placeholder="Enter average score" step="0.01" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentPosition" class="form-label">Position <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-award"></i></span>
                                    <input type="number" class="form-control" id="studentPosition" name="position" placeholder="Enter position" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentRemarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="ti ti-message"></i></span>
                                    <input type="text" class="form-control" id="studentRemarks" name="remarks" placeholder="Enter remarks, eg., PASSED" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="ti ti-x"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="createStudentBtn">
                                        <i class="ti ti-check"></i> Create Student
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>