<?php
  session_start();
  require("config.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/login_style.css">
    <title>Library Management System</title>
  </head>
  <body>

    <?php
      $errorlogin = $erroruser = $errorpass = "";
      if(isset($_REQUEST['stud_login'])){
        $username = $_REQUEST['stud_user'];
        $password = $_REQUEST['stud_pass'];
        if(empty($username)||empty($password)){
          if(empty($username)){
            $erroruser = "<script>alert('Username is mandatory!!');</script>";
            echo $erroruser;
          }
          else{
            $errorpass = "<script>alert('Password is mandatory!!');</script>";
            echo $errorpass;
          }
        }
        else{
          $query = "SELECT * FROM Student WHERE stud_rollno='".$username."' AND stud_pwd='".$password."' AND approval_status=1";
          $result = mysqli_query($con, $query);
          if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_array($result);
            $_SESSION['stud_rollno'] = $row['stud_rollno'];
            $_SESSION['stud_name'] = $row['stud_name'];
            header("location:index_stud.php");
          }
          else{
            $errorlogin = "<script>alert('Invalid username or password!!');</script>";
            echo $errorlogin;
          }
        }
      }
      if(isset($_REQUEST['admin_login'])){
        $user = $_REQUEST['admin_user'];
        $pwd = $_REQUEST['admin_pass'];
        if(empty($user)||empty($pwd)){
          if(empty($user)){
            $erroruser = "<script>alert('Username is mandatory!!');</script>";
            echo $erroruser;
          }
          else{
            $errorpass = "<script>alert('Password is mandatory!!');</script>";
            echo $errorpass;
          }
        }
        else{
          $query = "SELECT * FROM Admin WHERE admin_user='".$user."' AND admin_pwd='".$pwd."'";
          $result = mysqli_query($con, $query);
          if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_array($result);
            $_SESSION['admin_user'] = $row['admin_user'];
            $_SESSION['admin_name'] = $row['admin_name'];
            header("location:index_admin.php");
          }
          else{
            $errorlogin = "<script>alert('Invalid username or password!!');</script>";
            echo $errorlogin;
          }
        }
      }
    ?>

		<div class="row" style="background-image: url('assets/image/library_bg.jpeg');background-repeat: no-repeat;background-size: cover; height:100%;">
	    <div class="col-md-6 mx-auto p-0" align="right">
	        <div class="card" align="left">
	            <div class="login-box">
	                <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Student</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Admin</label>
	                    <div class="login-space">
                        <form class="" action="" method="POST">
	                        <div class="login">
	                            <div class="group"> <label class="label">Username</label> <input name="stud_user" type="text" class="input" placeholder="Enter your roll number"> </div>
	                            <div class="group"> <label class="label">Password</label> <input name="stud_pass" type="password" class="input" data-type="password" placeholder="Enter your password"> </div>
	                            <div class="group"> <input type="submit" name="stud_login" class="button" value="Sign In"> </div>
	                            <div class="hr"></div>
	                            <div class="foot"> <a href="stud_reg.php" style="color:white;">Register</a> </div>
	                        </div>
                        </form>

                        <form class="" action="" method="POST">
                          <div class="sign-up-form">
                            <div class="group"> <label class="label">Username</label> <input name="admin_user" type="text" class="input" placeholder="Enter your username"> </div>
                            <div class="group"> <label class="label">Password</label> <input name="admin_pass" type="password" class="input" data-type="password" placeholder="Enter your password"> </div>
                            <div class="group"> <input type="submit" name="admin_login" class="button" value="Sign In"> </div>
                            <div class="hr"></div>
	                        </div>
                        </form>

	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		</div>
	</body>
</html>
