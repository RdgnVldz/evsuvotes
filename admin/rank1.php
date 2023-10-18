<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	<?php include 'includes/menubar.php'; ?>
	<br><br>
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
		<div class="row">
			<div class="col-xs-12">
				<div class="content">
					<?php 
					$position_query=mysqli_query($conn,"SELECT * FROM positions");
					while ($position_rows=mysqli_fetch_array($position_query)){
					    $position_id=$position_rows['id'];
					    $position_description=$position_rows['description'];

					    $candidate_query=mysqli_query($conn,"SELECT * FROM candidates WHERE position_id='$position_id'");
					    ?>
					    <div class="col-sm-6"> <!-- Add col-sm-6 class to create a half-width column -->
					        <div class="table-responsive">
					            <h2><?php echo $position_description; ?></h2>
					            <table class="table table-bordered" style="background-color: #fff" id="log_<?php echo $position_id; ?>">
					                <thead>
					                    <tr>
					                        <th>Name of Candidates</th>
					                        <th>No. of Votes</th>
					                    </tr>
					                </thead>
					                <tbody>
					                    <?php
					                    while($candidate_rows=mysqli_fetch_array($candidate_query)){ 
					                        $id=$candidate_rows['id'];
					                    ?>
					                    <tr class="del<?php echo $id ?>">
					                        <td><?php echo $candidate_rows['firstname'] . ' ' . $candidate_rows['lastname']; ?></td>
					                        <td align="center">
					                            <?php 
					                            $votes_query=mysqli_query($conn,"SELECT * FROM votes WHERE candidate_id='$id' ORDER BY candidate_id DESC");
					                            $vote_count=mysqli_num_rows($votes_query);
					                            echo $vote_count;
					                            ?>
					                        </td>
					                    </tr>
					                    <?php } ?>
					                </tbody>
					            </table>
					        </div>
					    </div>
					    <script>
						  $(document).ready(function() {
						    $('#log_<?php echo $position_id; ?>').DataTable({
						        "order": [[1, "desc"]] // Sort by the 2nd column (No. of Votes) in descending order
						    });
						  });
						</script>
					    <?php
					}
					?>
				</div>
			</div>
		</div>
	</div>	
	<?php include('includes/footer.php')?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
