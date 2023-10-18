<!DOCTYPE html>
<html>
<head>
<style>
  /* Your existing styles */
  .main-header {
  display: flex;
  justify-content: center; /* Center horizontally */
  align-items: center; /* Center vertically */
  flex-direction: column; /* Stack header and menu vertically */
  text-align: center;
  width: 100%;
}


  .navbar-custom-menu {
    margin-top: auto; /* Push the custom menu to the bottom */
    display: flex;
    margin-right: 20px;
    align-items: center; /* Align items vertically */
  }

  .navbar-custom-menu .navbar-nav {
    margin: auto;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center; /* Align items vertically */
  }

  .navbar-custom-menu .navbar-nav li {
    margin-left: -10px; /* Add spacing between elements */
  }

  .navbar-custom-menu .user-image {
    width: 40px;
    height: 40px; /* Fixed typo in height */
    border-radius: 50%; /* Make it circular */
    object-fit: cover;
  }

  .navbar-custom-menu .hidden-xs {
    display: inline-block;
  }

  .navbar-brand {
    text-align: center;
  }
</style>
</head>
<body>

<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <!-- Navbar Header (Moved to the top) -->
      <div class="navbar-header">
        <img src="admin/includes/images/logo1.png" alt="logo" style="width: 200px; height: 50px; padding: 10px; margin 10px;">
      </div>

      <!-- Navbar Custom Menu (Remains at the bottom) -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav navbar-center"> <!-- Updated class name to navbar-center -->
          <li class="user user-menu">
            <a href="">
              <img src="<?php echo (!empty($voter['photo'])) ? 'images/'.$voter['photo'] : 'images/profile.jpg' ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $voter['firstname'].' '.$voter['lastname']; ?></span>
            </a>
          </li>
          <li><a style="margin-right: -40px;" href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>  
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='transaction.php'>TRANSACTION</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>

</body>
</html>
