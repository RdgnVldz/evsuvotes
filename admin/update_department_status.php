<?php
include 'includes/session.php';
include 'includes/header.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $statuses = $_POST['status'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE departments SET status = ? WHERE department_id = ?");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("si", $newStatus, $department_id);

    foreach ($statuses as $department_id => $newStatus) {
        // Sanitize user input to prevent SQL injection (consider using prepared statements)
        $department_id = mysqli_real_escape_string($conn, $department_id);
        $newStatus = mysqli_real_escape_string($conn, $newStatus);
        
        // Execute the SQL update query
        if (!$stmt->execute()) {
            die("Update failed: " . $stmt->error);
        }
    }

    $stmt->close();
}

// Your code to retrieve department information
$sql = "SELECT department_id, name, status FROM departments";
$result = $conn->query($sql);

if ($result === false) {
    $errorMessage = "Error executing the query: " . $conn->error;
}
?>

<html>
<head>
    <title>Update Department Status</title>
</head>
<style>
    .eye-catching-button {
    background-color: #800; /* Green background color */
    color: white; /* White text color */
    padding: 10px 20px; /* Padding for better spacing */
    border: none; /* Remove the border */
    border-radius: 5px; /* Add rounded corners */
    cursor: pointer; /* Add a pointer cursor on hover */
    font-size: 16px; /* Adjust font size */
}

.eye-catching-button:hover {
    background-color: #45a049; /* Darker green on hover */
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>
        <br><br>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><strong>Voting Status</strong></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <button class="btn btn-info btn-sm btn-flat"><a href="voting_status.php">Voting Status</a></button>
                    </div>
                    <div class="box-body table-responsive">
    <form method="POST">
        <table id="example1" class="table table-bordered">
            <thead>
                <th>Department Name</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $department_id = $row['department_id'];
                        $departmentName = $row['name'];
                        $status = $row['status'];

                        echo "<tr>";
                        echo "<td>$departmentName</td>";
                        echo "<td>$status</td>";
                        echo "<td>";
                        echo "<select name='status[$department_id]' id='status_$department_id'>";
                        echo "<option value='active' " . ($status == 'active' ? 'selected' : '') . ">Active</option>";
                        echo "<option value='inactive' " . ($status == 'inactive' ? 'selected' : '') . ">Inactive</option>";
                        echo "</select>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No departments found in the database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <input type='submit' value='Update' class='eye-catching-button'>
    </form>
</div>
    </div>
            </div>
        </div>
    </section>
  </div>
  <?php include 'includes/footer.php'; ?>
    </div>
  <?php include 'includes/scripts.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
