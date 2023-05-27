<?php

class Votes {
   
    function __construct($url) {
        include $url;
        $this->conn = $conn;
        $this->fetchVotes();
    }

    function fetchVotes() {
        $sql = "SELECT * FROM votes";
		$vquery = $this->conn->query($sql);
        $votes = [];
        foreach ($vquery as $key => $value) {
            array_push($votes, $value);
        }
        return $votes;
    }

    function fetchByVotersId($voters_id) {
        $sql = "SELECT * FROM votes JOIN candidates on votes.candidate_id = candidates.id  where votes.voters_id = '{$voters_id}'";
		$vquery = $this->conn->query($sql);
        $votes = [];
        foreach ($vquery as $key => $value) {
            array_push($votes, $value);
        }
        return $votes;
    }

    function setVote($data) {
        $query = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('{$data->voter_id}', '{$data->candidate_id}', '{$data->position_id}');";
        $vquery = $this->conn->query($query);
        return $vquery;
    }
}

?>