<!-- add_company_data_Modal -->
<div class="modal fade" id="modal_promote_edit_role" tabindex="-1" role="dialog" aria-labelledby="promote_edit_role_data_Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PromoteEmployeeTitle">Promote </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: red;" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="promoteEmployee">
             <div class="form-group">
            <label for="companyName"> Company</label>
             <select class="form-control" name="selectCompanyFromModal" id="selectCompanyFromModal">
              <option value="">Select a Company</option>
                  <?php 
                  $resultCompany2=$comp->all_company_details();
                   if($resultCompany2){
                    print_r($resultCompany2);

                               while($rowCompany2 = mysqli_fetch_array($resultCompany2))
                               {
                   ?>
                   <option class="form-control" value="<?php echo $rowCompany2['comp_id']; ?>"> <?php echo $rowCompany2['comp_name']; ?> </option>
                 <?php } } ?>
                </select>


            </div> 
            <div class="form-group">
            <label for="companyName"> Department</label>
             <select class="form-control" name="selectDepartmentFromModal" id="selectDepartmentFromModal">
                  <option value="">Select Company first</option>
             </select>
            </div> 
       
            <div class="form-group">
            <label for="companyName"> Designation</label>
             <select class="form-control" name="selectDesignationFromModal" id="selectDesignationFromModal">
                  <option value="">Select Department first</option>
             </select>
            </div> 
            <div class="form-group">
            <label for="companyName"> Job Nature</label>
             <select class="form-control" name="job_nature" id="job_nature">
                  <option value="">Select Department first</option>
                  <option value="1">Full Time</option>
                  <option value="0">Part Time</option>
             </select>
            </div> 
            <div class="form-group">
            <label for="companyName">Notes</label>
                  <input name="notes" id="notes" type="text" class="form-control">
            </div> 
           
              <div class="form-group">
            <label for="companyName"> Salary</label>
            <input name="salary" id="salary" type="number" class="form-control">
            </div> 

            <div class="form-group">
            <label for="companyName">start Date</label>
            <input name="date_pickerModal" id="date_pickerModal" type="text" class="form-control">
            </div> 
           
      
      </div>
      <div class="modal-footer">
             
              <input type="hidden" name="employee_id"id="employee_id" value="">
              <input type="hidden" name="job_role_id"id="job_role_id" value="">
              <input type="hidden" name="actionValue"id="actionValue" value="promoteEmployee">

        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close" aria-hidden="true"></i>Close</button>
        <button type="submit" name="submitType" id="submitType" value="promote" class="btn btn-primary"><i class="fas fa-save"></i> Promote</button>
          </form>

        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Employee Promoted Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
      
      </div>
    </div>
  </div>
</div>