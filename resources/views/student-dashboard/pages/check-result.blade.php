<div class="row">
    <!-- Result Check Form -->
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-center py-3">
                <h4 class="mb-0 text-white">Check Result</h4>
            </div>
            <div class="card-body">

                <form id="resultCheckForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Registration Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="ti ti-id"></i></span>
                            <input type="text" id="reg_no" name="reg_no" class="form-control" placeholder="Enter registration number" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="ti ti-user"></i></span>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Class</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="ti ti-school"></i></span>
                            <select id="class" name="class" class="form-select text-black" required>
                                <option value="">Select class</option>
                                <option value="BASIC 1">Basic 1</option>
                                <option value="BASIC 2">Basic 2</option>
                                <option value="BASIC 3">Basic 3</option>
                                <option value="BASIC 4">Basic 4</option>
                                <option value="BASIC 5">Basic 5</option>
                                <option value="BASIC 6">Basic 6</option>
                                <option value="BASIC 7">Basic 7</option>
                                <option value="BASIC 8">Basic 8</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="ti ti-calendar"></i></span>
                            <select id="semester" name="semester" class="form-select text-black" required>
                                <option value="">Select semester</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="ti ti-lock"></i></span>

                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter account password" required>

                            <span class="input-group-text bg-light" id="togglePassword" style="cursor:pointer;">
                                <i class="ti ti-eye-off" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Check Result</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Result Display -->
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-center py-3">
                <h4 class="mb-0 text-white">Student Result</h4>
            </div>
            <div class="card-body">

                <div id="resultDisplay" class="scrollable" style="height: 465px; overflow-y: auto;">
                    <p class="text-muted">Fill the form and submit to view result...</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("ti-eye-off");
            icon.classList.add("ti-eye");
        } else {
            input.type = "password";
            icon.classList.remove("ti-eye");
            icon.classList.add("ti-eye-off");
        }
    });
</script>
