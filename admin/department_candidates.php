<?php
include 'includes/session.php';
// Fetch candidates with position information from the "department_candidates" and "department_positions" tables
$sql = "SELECT c.id AS candidate_id, c.firstname, c.lastname, c.partylist, c.photo, p.description AS position_description
        FROM department_candidates c
        JOIN department_positions p ON c.position_id = p.id";
$result = mysqli_query($conn, $sql);
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <br><br>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <strong>Department Candidates Lists</strong>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Candidates</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
        <div>
          <button class="btn btn-info btn-sm btn-flat"><a href="candidates.php" style="color: #fff;">Candidates</a></button>
          <button class="btn btn-sm btn-flat" style="background-color: #0044cc; color: #fff;"><a href="department_candidates.php" style="text-decoration: none; color: #fff;">Department Candidates</a></button>
        </div>
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body table-responsive">
<!-- HTML table to display department_candidates with position information -->
<table id="example1" class="table table-bordered">
    <thead>
        <tr>
            <th class="hidden"></th>
            <th>Position</th>
            <th>Photo</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Partylist</th>
            <th>Tools</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are candidates
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
            <tr>
                <td class='hidden'></td>
                <td>" . $row['position_description'] . "</td>
                <td>
                    <img src='" . $row['photo'] .  "' width='30px' height='30px'>
                    <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='" . $row['candidate_id'] . "'><span class='fa fa-edit'></span></a>
                </td>
                <td>" . $row['firstname'] . "</td>
                <td>" . $row['lastname'] . "</td>
                <td>" . $row['partylist'] . "</td>
                <td style='text-align: center'>
                    <a class='btn-success btn-lg edit btn-flat' data-id='" . $row['candidate_id'] . "'><i class='fa fa-edit'></i></a>
                    <a class='btn-danger btn-lg delete btn-flat' data-id='" . $row['candidate_id'] . "'><i class='fa fa-trash'></i></a>
                </td>
            </tr>
        ";
    }
} else {
    echo "<tr><td colspan='6'>No candidates found.</td></tr>";
}
        ?>
    </tbody>
</table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/candidates_modal.php'; ?>
</div>
    <?php include 'includes/scripts.php'; ?>
    <script></script>
<?php
// Close the database connection
mysqli_close($conn);
?>
