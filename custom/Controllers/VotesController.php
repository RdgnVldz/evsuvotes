<?php 
    include('../Votes.php');
    $votes = new Votes('../../includes/conn.php');

    if (isset($_GET['action'])):
        switch ($_GET['action']) {
            case 'fetch':
                echo json_encode($votes->fetchVotes());
                break;
            case 'fetchByVotersId':
                $id = $_GET['voters_id'];
                echo json_encode($votes->fetchByVotersId($id));
                break;
            case 'setVote':
                $data = json_decode(file_get_contents('php://input'));
                foreach ($data->data as $key => $value) {
                    $votes->setVote($value);
                }
                echo json_encode(['message'=>'success']);
            default:
                # code...
                break;
        }
    endif;
?>