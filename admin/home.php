<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
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
        <strong>Dashboard</strong>
      </h1>
      <ol class="breadcrumb" >
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
              <div class="inner">
                  <h3 id="position-count">Loading...</h3>
                  <p>No. of Positions</p>
              </div>
              <div class="icon">
                  <i class="fa fa-tasks"></i>
              </div>
              <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="candidate-count">Loading...</h3>
              <p>No. of Candidates</p>
            </div>
            <div class="icon">
              <i class="fa fa-black-tie"></i>
            </div>
            <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="total_voters-count">Loading...</h3>
              <p>Total Voters</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="voted-count">Loading...</h3>
              <p>Voters Voted</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>
            <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-xs-12">
          <h3>Votes Tally
            <span class="pull-right">
              <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
            </span>
          </h3>
        </div>
      </div>

        <div class="row" id="chart-container">
        <!-- Your content will be dynamically loaded here -->
        </div>

      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>


  <script>
    // Para ha Card Position counting
    $(document).ready(function() {
        function fetchPositionCount() {
            $.ajax({
                type: "GET",
                url: "real_time/fetch_position_count.php", 
                success: function(data) {
                    $("#position-count").text(data);
                }
            });
        }

        
        fetchPositionCount();

        setInterval(fetchPositionCount, 5000); // Mag update an data every 5 seconds. Kamo nala pag adjust kun pera kaseconds an iyo gusto para pag fetch han data.
    });


    // Para ha Card Candidates counting
    $(document).ready(function() {
        function fetchCandidateCount() {
            $.ajax({
                type: "GET",
                url: "real_time/fetch_candidate_count.php", 
                success: function(data) {
                    $("#candidate-count").text(data);
                }
            });
        }

        
        fetchCandidateCount();

        setInterval(fetchCandidateCount, 5000); // Mag update an data every 5 seconds. Kamo nala pag adjust kun pera kaseconds an iyo gusto para pag fetch han data.
    });

     // Para ha Card Total Voters counting
    $(document).ready(function() {
        function fetchTtlVotersCount() {
            $.ajax({
                type: "GET",
                url: "real_time/fetch_total_voters_count.php", 
                success: function(data) {
                    $("#total_voters-count").text(data);
                }
            });
        }

        
        fetchTtlVotersCount();

        setInterval(fetchTtlVotersCount, 5000); // Mag update an data every 5 seconds. Kamo nala pag adjust kun pera kaseconds an iyo gusto para pag fetch han data.
    });

     // Para ha Card Voters Voted counting
    $(document).ready(function() {
        function fetchVotersCount() {
            $.ajax({
                type: "GET",
                url: "real_time/fetch_voters_count.php", 
                success: function(data) {
                    $("#voted-count").text(data);
                }
            });
        }

        
        fetchVotersCount();

        setInterval(fetchVotersCount, 5000); // Mag update an data every 5 seconds. Kamo nala pag adjust kun pera kaseconds an iyo gusto para pag fetch han data.
    });

    $(document).ready(function () {
        loadCharts(); // Initial load
        setInterval(loadCharts, 5000); // Refresh every 5 seconds

        function loadCharts() {
            $.ajax({
                url: 'real_time/load_charts.php', // Create this file to fetch data
                type: 'GET',
                success: function (data) {
                    $('#chart-container').html(data); // Update the chart container
                }
            });
        }
    });
  </script>

</body>
</html>
