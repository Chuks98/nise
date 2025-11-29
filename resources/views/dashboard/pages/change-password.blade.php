<div class="row justify-content-center">
  <div class="col-lg-8 col-md-10"> 
    <div class="card shadow">
      <div class="card-header bg-primary text-center py-3">
        <h4 class="mb-0 text-white">Change Password</h4>
      </div>
      
      <div class="card-body">
        <form id="changePasswordForm">
          <div class="mb-3">
            <label for="username" class="form-label">User</label>
            <div class="input-group">
              <span class="input-group-text bg-light">
                <i class="ti ti-user text-black"></i>
              </span>
              <input type="text" id="username" class="form-control" value="Admin" disabled/>
            </div>
          </div>

          <div class="mb-3">
            <label for="currentPassword" class="form-label">Current Password</label>
            <div class="input-group">
              <span class="input-group-text bg-light">
                <i class="ti ti-lock text-black"></i>
              </span>
              <input type="password" id="currentPassword" class="form-control text-black" placeholder="Enter current password" required/>
              <span class="input-group-text bg-light toggle-password" data-target="#currentPassword">
                <i class="ti ti-eye text-black"></i>
              </span>
            </div>
          </div>

          <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <div class="input-group">
              <span class="input-group-text bg-light">
                <i class="ti ti-lock text-black"></i>
              </span>
              <input type="password" id="newPassword" class="form-control text-black" placeholder="Enter new password" required/>
              <span class="input-group-text bg-light toggle-password" data-target="#newPassword">
                <i class="ti ti-eye text-black"></i>
              </span>
            </div>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary">
              <i class="ti ti-key"></i> 
              Change Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
