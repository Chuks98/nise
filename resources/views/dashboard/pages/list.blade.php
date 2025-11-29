<div class="row mt-4">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="card-title">Uploaded Scores</h4>

        <!-- Filters -->
        <div class="row mb-3">
          <div class="col-md-2">
            <label for="filterClass" class="form-label">Class</label>
            <select id="filterClass" class="form-select">
              <option value="">All</option>
              <option value="Basic 1">Basic 1</option>
              <option value="Basic 2">Basic 2</option>
              <option value="Basic 3">Basic 3</option>
              <option value="Basic 4">Basic 4</option>
              <option value="Basic 5">Basic 5</option>
              <option value="Basic 6">Basic 6</option>
              <option value="Basic 7">Basic 7</option>
              <option value="Basic 8">Basic 8</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="filterSemester" class="form-label">Semester</label>
            <select id="filterSemester" class="form-select">
              <option value="">All</option>
              <option value="1st">1st</option>
              <option value="2nd">2nd</option>
              <option value="3rd">3rd</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="filterSession" class="form-label">Session</label>
            <input type="text" id="filterSession" class="form-control" placeholder="e.g., 2025/ 2026">
          </div>

          <div class="col-md-3">
            <label for="searchKeyword" class="form-label">Search Name / Reg No</label>
            <input type="text" id="searchKeyword" class="form-control" placeholder="Search...">
          </div>

          <div class="col-md-3 d-flex align-items-end">
            <button id="filterBtn" class="btn btn-primary w-100">
              <i class="ti ti-search"></i> Filter
            </button>
          </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="scoresTable">
            <thead>
              <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>S/No</th>
                <th>Name</th>
                <th>Reg No</th>
                <th>Class</th>
                <th>Semester</th>
                <th>Session</th>
                <th>Total</th>
                <th>Average</th>
                <th>Position</th>
                <th>Remarks</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="scoresTableBody">
              <!-- Records inserted via jQuery -->
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between mt-2">
          <button id="bulkDeleteBtn" class="btn btn-danger">Delete Selected</button>
          <div id="scoresPagination" class="d-flex flex-wrap"></div>
        </div>

      </div>
    </div>
  </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="editScoreModal" tabindex="-1" aria-labelledby="editScoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScoreModalLabel">Edit Score</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editScoreForm">
                    @csrf
                    <input type="hidden" id="editScoreId">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" placeholder="Name">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editRegNo" class="form-label">Reg No</label>
                            <input type="text" class="form-control" id="editRegNo" placeholder="Reg No">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editClass" class="form-label">Class</label>
                            <input type="text" class="form-control" id="editClass" placeholder="Class">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editSemester" class="form-label">Semester</label>
                            <input type="text" class="form-control" id="editSemester" placeholder="Semester">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editSession" class="form-label">Session</label>
                            <input type="text" class="form-control" id="editSession" placeholder="Session">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editTotal" class="form-label">Total</label>
                            <input type="number" class="form-control" id="editTotal" placeholder="Total">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editAverage" class="form-label">Average</label>
                            <input type="number" class="form-control" id="editAverage" placeholder="Average">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editPosition" class="form-label">Position</label>
                            <input type="number" class="form-control" id="editPosition" placeholder="Position">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="editRemarks" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="editRemarks" placeholder="Remarks">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveEditBtn" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>