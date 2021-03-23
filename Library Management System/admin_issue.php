<?php
  session_start();
  if(!isset($_SESSION['admin_user'])){
    header('location:login.php');
  }
  include_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Library Management System</title>
  <link rel="icon" type="image/png" href="assets/image/logo2.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body{
      font-family: "Serif";
    }

    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    .row.content {height: 450px}

    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
  </style>
</head>
<body>
<?php
  if(isset($_REQUEST["issue_book"])){
    $bid = $_REQUEST["book_id"];
    $roll = $_REQUEST["stud_rollno"];
    $date = $_REQUEST["issue_date"];
    $query = "SELECT * FROM Book WHERE book_id='".$bid."'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)==1){
      $row = mysqli_fetch_array($result);
      if($row['issued']==1){
        $error = "<script>alert('Book Already Issued!!Check BookID!!....');</script>";
      }
      else{
        $query = "SELECT * FROM Student WHERE stud_rollno='".$roll."'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result)==1){
          $query = "INSERT INTO BookIssue(book_id, stud_rollno, issue_date, fine) VALUES('".$bid."', '".$roll."', '".$date."', 0)";
          if(mysqli_query($con, $query)){
            $error = "<script>alert('Issued Successfully!!.....');</script>";
            $query = "UPDATE Book SET issued=1 WHERE book_id='".$bid."'";
            mysqli_query($con, $query);
          }
          else{
            $error = "<script>alert('Something went wrong!!.....');</script>";
          }
        }
        else{
          $error = "<script>alert('Student Not Found!!....');</script>";
        }
      }
    }
    else{
      $error = "<script>alert('Book Not Found!!....');</script>";
    }
    echo $error;
  }
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><p style="margin-top:-3px;color:white;"><img src="assets/image/logo-book.png" alt="" width="40" height="35">&nbsp;LMS</p></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index_admin.php">Home</a></li>
        <li><a href="admin_book.php">Books</a></li>
        <li><a href="admin_stud.php">Students</a></li>
        <li class="active"><a href="">Issue Book</a></li>
        <li><a href="admin_return.php">Return Book</a></li>
        <li><a href="admin_issued.php">Issued Book</a></li>
        <li><a href="admin_appr.php">Approvals</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="chnge_psswd.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-8 text-left">
      <h1>Issue Book</h1>
      <hr>
    </div>
  </div>
  <div class="row content" style="margin-top:-20%;">
    <div class="col-sm-12 text-left">
      <div class="form-group row">
        <form action="" method="POST">
          <div class="col-xs-2">
            <label for="ex2">BookID</label>
            <input class="form-control" id="book_id" name="book_id" type="text">
          </div>
          <div class="col-xs-2">
            <label for="ex2">Student Rollno</label>
            <input class="form-control" id="stud_rollno" name="stud_rollno" type="text">
          </div>
          <div class="col-xs-2">
            <label for="ex2">Book Title</label>
            <input class="form-control" id="book_name" name="book_name" type="text" disabled>
          </div>
          <div class="col-xs-2">
            <label for="ex2">Student Name</label>
            <input class="form-control" id="stud_name" name="stud_name" type="text" readonly>
          </div>

          <div class="col-xs-2">
            <label for="date">Issue Date</label>
            <input id="issue_date" name="issue_date" class="form-control" type="date">
            <script>
              document.getElementById('issue_date').valueAsDate = new Date();
            </script>
            <?php
              if(isset($_REQUEST["show"])){
                $bid = $_REQUEST["book_id"];
                $roll = $_REQUEST["stud_rollno"];
                $date = $_REQUEST["issue_date"];
                $msg = '<script>document.getElementById("book_id").value="'.$bid.'";document.getElementById("stud_rollno").value="'.$roll.'";';
                $query = "SELECT * FROM Book WHERE book_id='".$bid."'";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result)==1){
                  $row = mysqli_fetch_array($result);
                  $msg .= 'document.getElementById("book_name").value="'.$row["book_title"].'";';
                }
                $query = "SELECT * FROM Student WHERE stud_rollno='".$roll."'";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result)==1){
                  $row = mysqli_fetch_array($result);
                  $msg .= 'document.getElementById("stud_name").value="'.$row["stud_name"].'";';
                }
                $msg .= "document.getElementById('issue_date').value = '".$date."';";
                $msg .= "</script>";
                echo $msg;
              }
            ?>
          </div>
          <div class="col-xs-2" style="margin-top:2%;">
            <button class="btn btn-info" type="submit" name="show">Show Details</button>
            <button class="btn btn-success" type="submit" name="issue_book">Issue</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
