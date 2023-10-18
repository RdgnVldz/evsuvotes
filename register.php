<?php include 'includes/conn.php'; ?>
<?php
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $lastname = $_POST["lastname"];
  $firstname = $_POST["firstname"];
  $studentid = $_POST["studentid"];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $photo = $_POST["photo"];
  $duplicate = mysqli_query($conn, "SELECT * FROM voters WHERE studentid = '$studentid'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Student ID Has Already Taken'); </script>";
  }
  else {
    if ($password == $password) {
      $query = "INSERT INTO voters VALUES('','$studentid','$password','$firstname','$lastname','$photo')";
      mysqli_query($conn, $query);
      echo "<script> 
              alert('Registration Successful');
              window.location.href = 'index.php';
            </script>";
    } else {
      echo "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Register | EVSU VOTING SYSTEM</title> 
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
  background: #800;
  overflow: hidden;
}
::selection{
  background: rgba(26,188,156,0.3);
}
.container{
  max-width: 440px;
  padding: 0 20px;
  margin: 100px auto;
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
  padding: 30px 25px 25px 25px;
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
  padding-left: 5px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
}
form .row input:focus{
  border-color: #800;
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
  color: #800;
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
  color: #900303;
  text-decoration: none;
}
form .signup-link a:hover{
  text-decoration: underline;
}
.photo{
  margin-bottom: 15px;
}
  </style>
<body class="hold-transition " style="background-image: url('images/bg.jpg'); background-attachment: fixed; background-size: cover;">
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Registration</span></div>
        <form action="#" method="post" autocomplete="off">
          <div class="row">
            <input type="text" name="lastname" id="lastname" placeholder="Lastname" required>
          </div>
          <div class="row">
            <input type="text" name="firstname" id="firstname" placeholder="Firstname" required>
          </div>
          <div class="row">
            <input type="text" name="studentid" id="studentid" placeholder="Student ID" required>
          </div>
          <div class="row">
            <input type="password" name="password" id="password" placeholder="Password" required>
          </div>
            <div class="photo">
              <input type="file" id="photo" name="photo" accept="image/*">
            </div>
          <div class="row button">
            <input type="submit" name="submit" value="Register">
          </div>
          <div class="signup-link">Already have an account? <a href="index.php">Login Now</a></div>
        </form>
      </div>
    </div>

  </body>
</html>