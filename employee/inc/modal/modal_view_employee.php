 <!-- Modal -->
    <div class="modal fade " id="modal_view_employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
        <!-- <div class="modal-dialog modal-lg"> -->
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:white; ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                <div class="modal-body">
                    <center>
            <img class="profilePhoto_Class" src="" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                    <h3 class="media-heading" id="modalHeading">Name</h3>
                 </center>
                 <!-- <div class="d-flex justify-content-center"> -->
                    <div class="card">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                    <tbody>
                        <tr><td>Email:</td><td><label id="email"></label></td></tr>
                        <tr><td>MobileNo:</td><td><label id="mobileNo"></label></td></tr>
                        <tr><td>Address:</td><td><label id="address"></label></td></tr>
                        <tr><td>NID:</td><td><label id="nid"></label></td></tr>
                        <tr><td>DOB:</td><td><label id="dob"></label></td></tr>
                        <tr><td>Age:</td><td><label id="age"></label></td></tr>
                        <tr><td>Created:</td><td><label id="created_at"></label></td></tr>
                    </tbody>
                    </table>
       </div>
   </div>
                  
                    <hr>
                   <div class="card">
                    <center>
                        <p style="display: none;" id="noJobMessage"> 
                        </p>
                    </center>
                    <div class="table-responsive" id="jobDetailsDiv" > 
                  <p id="jobShowingTitle"> <strong>Current Job Details</strong> </p>
                    <p style="display: none;" class="text-left " id="EmployeeJobDetails">
                        <table class="table-responsive table-bordered" id="jobDetailsTable"> 
                            <thead>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th style="min-width: 100px;">Start Date</th>
                            <th  style="min-width: 100px;">End Date</th>
                            <th>Salary</th>
                            <th>Notes</th>
                            </thead>
                            <tbody id="jobDetailsTableBody">
                                
                            </tbody>
                           
                        </table>
                        <br>
                       
                    </p>
                    </div>
                    <center>
                    <button class="btn btn-primary SeeAllJobsBtn" id="" name="allJobsBtn"> See All Jobs</button>
                    <br>
                    </center>
                </div>
                <!-- end of card -->
                <hr>
                </div>  
               <!--  <div class="modal-footer"> -->
                    
                    <button type="button" class="btn btn-danger justify-content-sm-right mb-2" data-dismiss="modal">Close </button>
                 
               <!--  </div> -->
            
            </div>
        </div>
    </div>