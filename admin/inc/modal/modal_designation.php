<!-- add_company_data_Modal -->
<div class="modal fade" id="add_designation_data_Modal" tabindex="-1" role="dialog" aria-labelledby="add_designation_data_Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="companyDesignationTitle">Add Designation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: red;" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="designationForm">
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
            <label for="designationName">Designation Name</label>
            <input type="text" class="form-control" name="designationName" id="designationName" aria-describedby="emailHelp" placeholder="Enter Deisgnation Name" required="">
            </div>
           
      
      </div>
      <div class="modal-footer">
              <input type="hidden" name="hidden_designation_id" id="hidden_designation_id" value="" class="btn btn-success" />
             
              <input type="hidden" id="actionValue" name="actionValue" value="">

        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close" aria-hidden="true"></i>Close</button>
        <button type="submit" name="submitType" id="submitType" value="insert" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          </form>
      </div>
    </div>
  </div>
</div>