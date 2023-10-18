<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Voter</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="voters_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">First Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="middlename" class="col-sm-3 control-label">Middle Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="middlename" name="middlename" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Last Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                <label for="edit_course" class="col-sm-3 control-label">Course</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="course" name="course" required>
                      <option value="">Select a Course</option>
                      <!--BEM-->
                      <option value="BSE">BS Entrepreneurship</option>
                      <option value="BSA">BS Accountancy</option>
                      <option value="BSOA">BS Office Administration</option>
                      <option value="BSBAMarketing">BS Business Administration: Marketing Management</option>
                      <!--Education-->
                      <option value="BSEDMath">BS Education: Mathemathics</option>
                      <option value="BSEDScience">BS Education: Science</option>
                      <option value="BPEd">B Physical Education</option>
                      <option value="BTVTEdFSM">B Technical Vocational Teacher Education: Food Service Management</option>
                      <option value="BTVTEdGFD">B Technical Vocational Teacher Education: Garments & Fashion Design</option>
                      <option value="DTS">Diploma in Teaching Secondary</option>
                      <!--Engineering mga Gwapo -->
                      <option value="BSCE">BS Civil Engineering</option>
                      <option value="BSEE">BS Electrical Engineering</option>
                      <option value="BSIT">BS Information Technology</option>
                      <!--Technology-->
                      <option value="BSiTechElectrical">BS Industrial Technology: Electrical Technology</option>
                      <option value="BSiTechElectronics">BS Industrial Technology: Electronics Technology</option>
                      <option value="BSMTAutomotive">BS Mechanical Techology: Automotive Technology</option>
                      <option value="BSMTWF">BS Mechanical Techology: Welding & Fabrication</option>
                      <option value="BSHM">BS Hospitality Management</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="year" class="col-sm-3 control-label">Year</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="year" name="year" required>
                    <option value="">Select Year Level</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="studentid" class="col-sm-3 control-label">Student ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="studentid" name="studentid" required pattern="\d{4}-\d{5}" title="Please enter a valid student ID (e.g., 2020-35224)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Voter</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="voters_edit.php">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="edit_studentid" class="col-sm-3 control-label">Student ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_studentid" name="studentid" required pattern="\d{4}-\d{5}" title="Please enter a valid student ID (e.g., 2020-35224)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">First Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_middlename" class="col-sm-3 control-label">Middle Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_middlename" name="middlename">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Last Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_course" class="col-sm-3 control-label">Course</label>
                    <div class="col-sm-9">
                    <select class="form-control" id="edit_course" name="course" required>
                      <!--BEM-->
                      <option value="BSE">BS Entrepreneurship</option>
                      <option value="BSA">BS Accountancy</option>
                      <option value="BSOA">BS Office Administration</option>
                      <option value="BSBAMarketing">BS Business Administration: Marketing Management</option>
                      <!--Education-->
                      <option value="BSEDMath">BS Education: Mathemathics</option>
                      <option value="BSEDScience">BS Education: Science</option>
                      <option value="BPEd">B Physical Education</option>
                      <option value="BTVTEdFSM">B Technical Vocational Teacher Education: Food Service Management</option>
                      <option value="BTVTEdGFD">B Technical Vocational Teacher Education: Garments & Fashion Design</option>
                      <option value="DTS">Diploma in Teaching Secondary</option>
                      <!--Engineering mga Gwapo -->
                      <option value="BSCE">BS Civil Engineering</option>
                      <option value="BSEE">BS Electrical Engineering</option>
                      <option value="BSIT">BS Information Technology</option>
                      <!--Technology-->
                      <option value="BSiTechElectrical">BS Industrial Technology: Electrical Technology</option>
                      <option value="BSiTechElectronics">BS Industrial Technology: Electronics Technology</option>
                      <option value="BSMTAutomotive">BS Mechanical Techology: Automotive Technology</option>
                      <option value="BSMTWF">BS Mechanical Techology: Welding & Fabrication</option>
                      <option value="BSHM">BS Hospitality Management</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="edit_year" class="col-sm-3 control-label">Year</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="edit_year" name="year" required>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="edit_password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="voters_delete.php">
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>DELETE VOTER</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Import CSV Modal -->
<div class="modal fade" id="importCsvModal" tabindex="-1" role="dialog" aria-labelledby="importCsvModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importCsvModalLabel">Import CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="process_csv.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="csvFile">Choose CSV File:</label>
                        <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>


     