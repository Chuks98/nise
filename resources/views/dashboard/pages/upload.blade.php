<div class="row mt-4">
  <!-- Excel Upload Form -->
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="card-title">Upload Excel File</h4>

        <form id="excelUploadForm" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label for="excelFile" class="form-label">Select Excel File</label>
            <div class="input-group">
              <span class="input-group-text bg-light"><i class="ti ti-upload"></i></span>
              <input type="file" class="form-control text-black" id="excelFile" name="file" accept=".xlsx,.xls" required>
            </div>
            <small class="text-muted">Only .xlsx or .xls files are allowed.</small>
          </div>

          <button type="submit" class="btn btn-primary w-100">
            <i class="ti ti-cloud-upload"></i> Upload Excel
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Uploaded Excel Records -->
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="card-title">Uploaded Records</h4>

        <div id="csvRecordList" 
             class="comment-widgets scrollable common-widget" 
             data-simplebar="" 
             style="height: 465px; overflow-y: auto;">
          <!-- Excel records will be appended here via jQuery later -->
        </div>

        <div id="csvPaginationControls" 
             class="mt-3 d-flex justify-content-center flex-wrap">
          <!-- Pagination will appear here -->
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Preview Modal -->
<div class="modal fade" id="csvPreviewModal" tabindex="-1" aria-labelledby="csvPreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="csvPreviewLabel">CSV File Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead id="csvPreviewHead"></thead>
            <tbody id="csvPreviewBody"></tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-success" id="confirmCsvUpload">
          <i class="ti ti-check"></i> Confirm Upload
        </button>
      </div>
    </div>
  </div>
</div>
