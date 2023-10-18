<!-- Preview -->
<div class="modal fade" id="preview_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Vote Preview</h4>
            </div>
            <div class="modal-body">
              <div id="preview_body"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Platform -->
<div class="modal fade" id="platform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="candidate"></b></h4>
            </div>
            <div class="modal-body">
              <p id="plat_view"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- View Ballot -->
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex">
                <span type="" class="text-right" data-dismiss="modal">
                    <?php
                $id = $voter['id'];
                $sqlDate = "SELECT MAX(date_time) AS max_date FROM votes WHERE voters_id = '$id'";
                $queryDate = $conn->query($sqlDate);
                $dateRow = $queryDate->fetch_assoc();
                $maxDate = $dateRow['max_date'];

                // Display the date once
                echo "
                <div class='row'>
                    <span class='col-sm-12 text-right'>$maxDate</span>
                </div>
                ";
                ?>
                </span>
                <h4 class="modal-title">Your Votes</h4> 
            </div>
            <div class="modal-body">
                <?php
                $sqlVotes = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN positions ON positions.id=votes.position_id WHERE voters_id = '$id'  ORDER BY positions.priority ASC";
                $queryVotes = $conn->query($sqlVotes);
                while($row = $queryVotes->fetch_assoc()){
                    echo "
                    <div class='row votelist'>
                        <span class='col-sm-4'><span class='pull-right'><b>".$row['description']." :</b></span></span> 
                        <span class='col-sm-8'>".$row['canfirst']." ".$row['canlast']."</span>
                    </div>
                    ";
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmation_modal" tabindex="-1" role="dialog" aria-labelledby="confirmation_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="confirmation_modal_label">Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure with these votes?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirm_yes">Yes</button>
            </div>
        </div>
    </div>
</div>
