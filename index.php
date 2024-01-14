<?php
  require('dbcon.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="loginStyle.css">
  </head>
  <body>
    <div class="container-fluid">
  <form class="mx-auto" method="POST" >
    <h4 class="text-center">LOGIN</h4>
    <hr class="border border-primary border-1 opacity-55">
  <div class="mb-3 mt-4">
    <label for="adminName" class="form-label">User Email</label>
    <input type="email" class="form-control" id="adminName" placeholder="example@email.com" name="adminName" >
</div>
  <div class="mb-3">
    <label for="adminPass" class="form-label">Password</label>
    <input type="password" class="form-control" id="adminPass" placeholder="enter password" name="adminPass">
    
  </div>
  
  <button type="submit" name="submit" id="submit" class="btn btn-primary mt-4 fs-4">Login</button>
</form>
</div>
<?php
if(isset($_POST['submit'])) {
  $query="SELECT * FROM `admin_login` WHERE `Admin_Name`='$_POST[adminName]' AND `Admin_Password`='$_POST[adminPass]' ";
  $result=mysqli_query($conn,$query);
  if(mysqli_num_rows($result)==1){
    session_start();
    $_SESSION['AdminLoginId']=$_POST['adminName'];
    header("Location: dashboard.php");
  }
  else{
    echo "<script>alert('Invalid Username or Password')</script>";
  }
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>