<?php

$conn = new mysqli('localhost', 'root', '', 'evsuvotes');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT COUNT(*) as count FROM voters";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["count"];
} else {
    echo "0";
}

$conn->close();
?>
