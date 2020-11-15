<!-- add_company_data_Modal -->
<div class="modal fade" id="add_company_data_Modal" tabindex="-1" role="dialog" aria-labelledby="add_company_data_Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="companyModalTitle">Add Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: red;" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="companyForm">
            <div class="form-group">
            <label for="companyName">Company Name</label>
            <input type="text" class="form-control" name="companyName" id="companyName" aria-describedby="emailHelp" placeholder="Enter Company Name" required="">
            </div>
      
      </div>
      <div class="modal-footer">
              <input type="hidden" name="hidden_company_id" id="hidden_company_id" value="" class="btn btn-success" />
             
              <input type="hidden" id="actionValue" name="actionValue" value="">

        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close" aria-hidden="true"></i>Close</button>
        <button type="submit" name="submitType" id="submitType" value="insert" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          </form>
      </div>
    </div>
  </div>
</div>