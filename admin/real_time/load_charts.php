<?php
// Database connection and SQL query to fetch data
$conn = new mysqli('localhost', 'root', '', 'evsuvotes');
$sql = "SELECT * FROM positions ORDER BY priority ASC";
$query = $conn->query($sql);

function slugify($text) {
    // Your slugify logic here (as described in a previous response)
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

// Initialize an output variable
$output = '';

while ($row = $query->fetch_assoc()) {
    // Fetch data for the current position
    $positionId = $row['id'];
    $positionDescription = $row['description'];

    // Construct the data arrays for the chart
    $carray = array();
    $varray = array();

    // Fetch candidate and vote data for the current position (modify this part)
    $candidatesSql = "SELECT * FROM candidates WHERE position_id = '$positionId'";
    $candidatesQuery = $conn->query($candidatesSql);

    while ($candidate = $candidatesQuery->fetch_assoc()) {
        array_push($carray, $candidate['lastname']);

        $votesSql = "SELECT * FROM votes WHERE candidate_id = '" . $candidate['id'] . "'";
        $votesQuery = $conn->query($votesSql);
        array_push($varray, $votesQuery->num_rows);
    }

    // Sort the data arrays in descending order based on votes
    array_multisort($varray, SORT_DESC, $carray);

    // Encode data arrays as JSON
    $carray = json_encode($carray);
    $varray = json_encode($varray);

    // Append the chart HTML to the output variable
    $output .= "
        <div class='col-sm-6'>
            <div class='box box-solid'>
                <div class='box-header with-border'>
                    <h4 class='box-title'><b>$positionDescription</b></h4>
                </div>
                <div class='box-body'>
                    <div class='chart'>
                        <canvas id='".slugify($positionDescription)."' style='height:200px'></canvas>
                    </div>
                </div>
            </div>
        </div>
    ";

    // Chart generation code for each position
    $output .= "
        <script>
            $(function () {
                var rowid = '$positionId';
                var description = '".slugify($positionDescription)."';
                var barChartCanvas = $('#'+description).get(0).getContext('2d');
                var barChartData = {
                    labels: $carray,
                    datasets: [
                        {
                            label: 'Votes',
                            fillColor: 'rgba(60,141,188,0.9',
                            strokeColor: 'rgba(60,141,188,0.8)',
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: $varray
                        }
                    ]
                };
                var barChartOptions = {
                    // ... (your existing options)
                };

                var myChart = new Chart(barChartCanvas).HorizontalBar(barChartData, barChartOptions);
            });
        </script>
    ";
}

// Send the generated HTML back to the front-end
echo $output;

$conn->close();
?>
