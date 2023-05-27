<?php

    class Candidates {

        function __construct($url) {
            include $url;
            $this->conn = $conn;
            $this->fetchCandidates();
        }

        function fetchCandidates() {
            $sql = "SELECT *, candidates.id as candidates_id  FROM candidates INNER JOIN positions ON candidates.position_id = positions.id ORDER BY positions.priority ASC";
			$query = $this->conn->query($sql);
            $candidates = [];
            foreach ($query as $key => $value) {
                array_push($candidates, $value);
            }
            return $candidates;
        }
    }
?>