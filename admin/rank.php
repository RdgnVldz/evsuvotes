<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
// Initialize an associative array to store candidate data by position
$positionData = array();

$position_query = mysqli_query($conn, "SELECT * FROM positions");
while ($position_rows = mysqli_fetch_array($position_query)) {
    $position_id = $position_rows['id'];
    $position_description = $position_rows['description'];

    $candidateData = array(); // Initialize an array to store candidate data for this position

    $candidate_query = mysqli_query($conn, "SELECT * FROM candidates WHERE position_id='$position_id'");

    while ($candidate_rows = mysqli_fetch_array($candidate_query)) {
        $candidateName = $candidate_rows['firstname'] . ' ' . $candidate_rows['lastname'];
        $id = $candidate_rows['id']; // Fetch the candidate's ID

        // Calculate the total number of votes for this candidate
        $votes_query = mysqli_query($conn, "SELECT * FROM votes WHERE candidate_id='$id'");
        $totalVotes = mysqli_num_rows($votes_query);

        // Calculate the total number of votes for this position
        $totalPositionVotes_query = mysqli_query($conn, "SELECT * FROM votes WHERE position_id='$position_id'");
        $totalPositionVotes = mysqli_num_rows($totalPositionVotes_query);

        // Calculate the percentage of votes for the candidate
        $percentage = ($totalVotes / $totalPositionVotes) * 100;

        // Add candidate data to the array for this position
        $candidateData[] = array(
            'name' => $candidateName,
            'percentage' => $percentage
        );
    }

    // Add the candidate data for this position to the positionData array
    $positionData[$position_description] = $candidateData;
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	<?php include 'includes/menubar.php'; ?>
<br>
<br>
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        <strong>Rank</strong>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rank</li>
      </ol>
    </section>
    <div class="box-body">
    <div>
        <?php
        // Generate separate bar graphs for each position
        foreach ($positionData as $position_description => $candidates) {
            echo "<h2>$position_description</h2>";
            echo '<canvas id="barChart_' . str_replace(' ', '_', $position_description) . '" width="400" height="200"></canvas>';
        }
        ?>
    </div>
</div>

<script>
<?php
// Generate JavaScript code to create bar graphs for each position
foreach ($positionData as $position_description => $candidates) {
    $candidateNames = array_column($candidates, 'name');
    $votePercentages = array_column($candidates, 'percentage');

    // Sort the data in ascending order of vote percentages
    array_multisort($votePercentages, SORT_DESC, $candidateNames);

    echo "var ctx = document.getElementById('barChart_" . str_replace(' ', '_', $position_description) . "').getContext('2d');";
    echo "var data = {
        labels: " . json_encode($candidateNames) . ",
        datasets: [{
            label: 'Percentage of Votes',
            data: " . json_encode($votePercentages) . ",
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(0, 119, 204, 1)',
            borderWidth: 1
        }]
    };

    var options = {
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    };

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });";
}
?>
</script>
    </div>
</div>
<?php include('includes/footer.php')?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
