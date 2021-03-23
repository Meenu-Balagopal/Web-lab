<?php
  include_once("config.php");
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
    if(isset($_REQUEST['submitt']))
    {
      $stud_rollno = $_REQUEST['stud_rollno'];
      $stud_name = $_REQUEST['stud_name'];
      $stud_mob = $_REQUEST['stud_mob'];
      $stud_email = $_REQUEST['stud_email'];
      $stud_pwd = $_REQUEST['stud_pwd'];
      $msg = "";
      echo "Hai";
      $query="INSERT INTO Student VALUES('".$stud_rollno."','".$stud_name."','".$stud_email."',$stud_mob,'".$stud_pwd."',0)";
      if(mysqli_query($con,$query))
      {
        echo "Hai";
        $msg .= '<script>alert("SUCCESSFULLY RECORDED");</script>';
        echo $msg;
      }
      else
      {
        $query="SELECT * FROM Student WHERE stud_rollno='$stud_rollno'";
        $result = mysqli_query($con,$query);
        echo "Hai";
        if (mysqli_num_rows($result)>0)
        {
          $msg .= '<script>alert("RECORD ALREADY EXIST ");</script>';
          echo $msg;
        }
        else{
          $msg .= "<script>alert('Something Went Wrong!');</script>";
          echo $msg;
        }
      }

    }
    ?>
    <form action="" method="POST" >
    		<div class="row">
    	    <div class="col-md-6 mx-auto p-0" align="center">
    	        <div class="card" align="left">
    	            <div class="login-box" style="margin-top:-10%;">
    	                <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Register</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
    	                    <div class="login-space">
                            <br><br>
    	                        <div class="login" >
    	                            <div class="group"> <label for="rollno" class="label">Rollno</label> <input name="stud_rollno" type="text" class="input" placeholder="Enter Rollno" required=""> </div>
    	                            <div class="group"> <label for="name" class="label">Name</label> <input name="stud_name" type="text" class="input" placeholder="Enter Name" required=""> </div>
                                  <div class="group"> <label for="email" class="label">MobNo</label> <input name="stud_mob" type="text" class="input" placeholder="Enter Mobile Number" required=""> </div>
                                  <div class="group"> <label for="mob" class="label">EmailID</label> <input name="stud_email" type="text" class="input" placeholder="Enter EmailID" required=""> </div>
    	                            <div class="group"> <label for="pass" class="label">Password</label> <input name="stud_pwd" type="password" class="input" data-type="password" placeholder="Enter Password" required=""> </div>
    	                            <div class="group"> <input type="submit" class="button" value="Register" name="submitt"> </div>
    	                            <br><hr><br>
                                  <div class="foot"> <a href="login.php" style="color:white;">LogIn</a> </div>
    	                        </div>
    	                    </div>
    	                </div>
    	            </div>
    	        </div>
    	    </div>
    		</div>
    </form>
	</body>
</html>
