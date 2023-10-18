<?php include 'includes/session.php'; ?>
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
        <strong>Accounts</strong>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Accounts</li>
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
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Photo</th>
                    <th>Created On</th>
                    <th>User Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  // SQL query to fetch admin data
                  $sql = "SELECT * FROM admin";
                  $result = $conn->query($sql);

                  // Check if there are results
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Set the image URL or use the default if empty
                        $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.jpg';
                
                        echo "<tr>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["firstname"] . "</td>";
                        echo "<td>" . $row["lastname"] . "</td>";
                        echo "<td><img src='" . $image . "' width='30px' height='30px'></td>";
                        echo "<td>" . $row["created_on"] . "</td>";
                        echo "<td>" . ($row["user_role"] == 1 ? "Admin" : "Super Admin") . "</td>";
                
                        // Check if the user_role is not "Super Admin" before rendering the delete icon
                        if ($row["user_role"] != 2) { // Assuming "Super Admin" has user_role value of 2
                            echo "<td style='text-align: center;'><a class='btn-danger btn-lg' href='admin_delete.php?id=" . $row["id"] . "'><i class='fa fa-trash'></i></a></td>";
                        } else {
                            echo "<td></td>"; // Leave an empty cell for "Super Admin"
                        }
                
                        echo "</tr>";
                    }
                }                
                  // Close the database connection
                  $conn->close();
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
  <?php include 'includes/admin_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
