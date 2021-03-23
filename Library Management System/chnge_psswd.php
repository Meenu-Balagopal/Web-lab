<?php
  session_start();
  include_once("config.php");

  if(isset($_SESSION['admin_user'])){
    $username = $_SESSION['admin_user'];
    if(isset($_REQUEST['change_pwd'])){
      if($_REQUEST['new_pass']==$_REQUEST['confirm_pass']){
        $query = "UPDATE Admin SET admin_pwd='".$_REQUEST["new_pass"]."' WHERE admin_user='".$username."'";
        if(mysqli_query($con, $query)){
          $pop = "<script>alert('Password changed successfully!!............');</script>";
          header("location:index_admin.php");
        }
        else{
          $pop = "<script>alert('Some Error Occured!!............');</script>";
        }
        echo $pop;
      }
      else{
        $pop = "<script>alert('Password Mismatch!!.........');</script>";
        echo $pop;
      }
    }
  }

  elseif (isset($_SESSION['stud_rollno'])) {
    $username = $_SESSION['stud_rollno'];
    if(isset($_REQUEST['change_pwd'])){
      if($_REQUEST['new_pass']==$_REQUEST['confirm_pass']){
        $query = "UPDATE Student SET stud_pwd='".$_REQUEST["new_pass"]."' WHERE stud_rollno='".$username."'";
        if(mysqli_query($con, $query)){
          $pop = "<script>alert('Password changed successfully!!............');</script>";
          header("location:index_stud.php");
        }
        else{
          $pop = "<script>alert('Some Error Occured!!............');</script>";
        }
        echo $pop;
      }
      else{
        $pop = "<script>alert('Password Mismatch!!.........');</script>";
        echo $pop;
      }
    }
  }

  else{
    header('location:login.php');
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/login_style.css">
    <title>Library Management System</title>
  </head>
  <body>
		<div class="row">
	    <div class="col-md-6 mx-auto p-0" align="center">
	        <div class="card" align="left">
	            <div class="login-box">
	                <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Change Password</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
	                    <div class="login-space">
                        <br><br>
                        <form action="" method="POST">
                          <div class="login">
	                            <div class="group"> <label for="new_pass" class="label">New Password</label> <input id="new_pass" name="new_pass" type="password" class="input" placeholder="Enter New Password"> </div>
	                            <div class="group"> <label for="confirm_pass" class="label">Retype Password</label> <input id="confirm_pass" name="confirm_pass" type="password" class="input" placeholder="Retype Password"> </div>
	                            <div class="group"> <input type="submit" name="change_pwd" class="button" value="Change Password"> </div>
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
