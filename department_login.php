
<?php
// Include your session.php to establish a database connection
include 'includes/conn.php';

// Check the status of SSG Voting
$sql = "SELECT status FROM votingtypes WHERE type_name = 'Department Voting'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];

    // If the status is "inactive," redirect to an error page or show an error message
    if ($status == 'inactive') {
        // You can redirect to an error page like this:
        // header("Location: error.php");

        // Or display an error message
        echo "The Department Voting is currently inactive. Please try again later.";
        exit; // Terminate script execution
    }
}

// The rest of your login page code goes here

// Close the database connection
mysqli_close($conn);
?>
<?php
    session_start();
    if(isset($_SESSION['admin'])){
      header('location: admin/home.php');
    }

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EVSU VOTING SYSTEM</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;
}
body{
  background: #1abc9c;
  overflow: hidden;
  background-image: url('images/bg7.png');
            background-attachment: fixed;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
}
::selection{
  background: rgba(26,188,156,0.3);
}
 @media (max-width: 767px) {
    body {
      background-image: url('images/bg7p.png');
      background-attachment: fixed;
      background-size: 100% 100%;
      /* You can also adjust other background properties like size and attachment here if needed */
    }
  }
.container{
  max-width: 440px;
  padding: 0 20px;
  margin: 70px auto;
}
.wrapper{
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);
}
.wrapper .title{
  height: 90px;
  background: #800000;
  border-radius: 5px 5px 0 0;
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form{
  padding: 30px 25px 10px 25px;
}
.wrapper form .row{
  height: 45px;
  margin-bottom: 15px;
  position: relative;
}
.wrapper form .row input{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
}
form .row input:focus{
  border-color: #16a085;
  box-shadow: inset 0px 0px 2px 2px rgba(26,188,156,0.25);
}
form .row input::placeholder{
  color: #999;
}
.wrapper form .row i{
  position: absolute;
  width: 47px;
  height: 100%;
  color: #fff;
  font-size: 18px;
  background: #800000;
  border: 1px solid maroon;
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form .pass{
  margin: -8px 0 20px 0;
}
.wrapper form .pass a{
  color: #16a085;
  font-size: 17px;
  text-decoration: none;
}
.wrapper form .pass a:hover{
  text-decoration: underline;
}
.wrapper form .button input{
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background: #900303;
  border: 1px solid maroon;
  cursor: pointer;
}
form .button input:hover{
  background: #d40615;
}
.wrapper form .signup-link{
  text-align: center;
  margin-top: 20px;
  font-size: 17px;
}
.wrapper form .signup-link a{
  color: #800000;
  text-decoration: none;
}
form .signup-link a:hover{
  text-decoration: underline;
}
.showpass {
  text-align: left;
}
.wrapper form .terms {
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

.wrapper form .terms input[type="checkbox"] {
  transform: scale(1.5);
  margin-right: 10px;
}

.wrapper form .button {
  margin-top: 20px;
}
  </style>
<body class="hold-transition login-page"  >
<div class="container">
  <div class="login-logo" style="text-align: center;">
    <img src="images/favicon.png" alt="logo" style="width: 75px; height: 75px;">
    <div>
    <div>
  <img src="images/2nd.png" alt="logo" style="width: 350px; height: 75px; max-width: 100%;">
</div>

    </div>
  </div>
      <div class="wrapper">
        <div class="title"><span>Login</span></div>
        <form action="login_process_dept.php" method="POST">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="studentid" id="studentid" placeholder="Student ID" required>
          </div>            
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
          </div>
          <div class="terms">
            <label for="agree">
            <input type="checkbox" id="agree" name="terms_agreed"> I agree to the <a href="includes/rules.php" style="color: ">Terms and Conditions.</a>
            </label>
          </div>
          <div class="row button">
            <input type="submit" name="login" value="Login">
          </div>
          <!--- <div class="signup-link">Not a member? <a href="register.php">Signup Now</a></div> -->
        </form>
      </div>
      <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center mt20'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
    </div>
<?php include 'includes/scripts.php' ?>
  </body>
</html>