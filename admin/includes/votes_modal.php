<!-- Reset -->
<div class="modal fade" id="reset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Reseting...</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                  <p>RESET VOTES</p>
                  <h4>This will delete all votes and counting back to 0.</h4>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <a href="votes_reset.php" class="btn btn-danger btn-flat"><i class="fa fa-refresh"></i> Reset</a>
            </div>
        </div>
    </div>
</div>
<!-- Archive -->
<div class="modal fade" id="archive_select">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Archiving...</b></h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>ARCHIVE VOTE</p>
                    <h4>This will archive all the votes and counting back to 0.</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <a href="archive_selectprocess.php" class="btn btn-success btn-flat archive-confirm"><i class="fa fa-archive"></i> Confirm Archive</a>
            </div>
        </div>
    </div>
</div>
<!-- Unarchive -->
<div class="modal fade" id="unarchive">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Unarchiving...</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                  <p>UNARCHIVE VOTES</p>
                  <h4>This will unarchive all the votes and will be counted again.</h4>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <a href='unarchive_process.php?id=".$row['id']."' class="btn bg-yellow btn-flat"><i class="fa fa-archive"></i> Unarchive</a>
            </div>
        </div>
    </div>
</div>
<!-- Permanent Delete -->
<div class="modal fade" id="permanentdelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                  <p>DELETE VOTES</p>
                  <h4>This will permanently delete all votes.</h4>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <a href="permanent_delete.php" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Permanent Delete</a>
            </div>
        </div>
    </div>
</div>
