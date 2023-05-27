<?php 
    include('../Candidates.php');
    $votes = new Candidates('../../includes/conn.php');

    if (isset($_GET['action'])):
        switch ($_GET['action']) {
            case 'fetch':
                echo json_encode($votes->fetchCandidates());
                break;
            default:
                # code...
                break;
        }
    endif;
?>