<?php
  session_start();
  if(!isset($_SESSION['admin_user'])){
    header('location:login.php');
  }
  include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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

    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    th{
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
      color: white;
      background-color: black;
    }

    td{
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href=""><p style="margin-top:-3px;color:white;"><img src="assets/image/logo-book.png" alt="" width="40" height="35">&nbsp;LMS</p></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index_admin.php">Home</a></li>
        <li><a href="admin_book.php">Books</a></li>
        <li><a href="admin_stud.php">Students</a></li>
        <li><a href="admin_issue.php">Issue Book</a></li>
        <li><a href="admin_return.php">Return Book</a></li>
        <li><a href="admin_issued.php">Issued Book</a></li>
        <li class="active"><a href="">Approvals</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="chnge_psswd.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
  if(isset($_REQUEST['approve'])){
    $rollno = $_REQUEST['rollno'];
    $query = "UPDATE Student SET approval_status=1 WHERE stud_rollno='".$rollno."'";
    mysqli_query($con, $query);
    $msg = "<script>alert('Student Record Approved Successfully!!');</script>";
    echo $msg;
  }
  if(isset($_REQUEST['delete'])){
    $rollno = $_REQUEST['rollno'];
    $query = "DELETE FROM Student WHERE stud_rollno='".$rollno."'";
    mysqli_query($con, $query);
    $msg = "<script>alert('Student Record Deleted Successfully!!');</script>";
    echo $msg;
  }
?>
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-12 text-left">
      <h1>Approvals</h1>
      <hr>
    </div>
  </div>
  <br>
  <form class="" action="" method="post">
    <div class="input-append" align="right" style="margin-right:35px;">
      <select size="1" name="select" class="form-select form-select-sm" aria-label=".form-select-sm example">
        <option value="RollNo">RollNo</option>
        <option value="Student Name">Student Name</option>
      </select>
      <input type="text" placeholder="search by" id="searchby" name="searchby"/>
      <button class="btn btn-info" name="search">Search</button>
    </div>
    <br>
    <div class="row content">
      <div class="col-sm-2 text-left">
      </div>
      <div class="col-sm-8 text-left">
        <input type="hidden" id="rollno" name="rollno">
        <table>
          <tr>
            <th>Rollno</th>
            <th>Student Name</th>
            <th>EmailID</th>
            <th>Mobile</th>
            <th width="35%"></th>
          </tr>
          <?php
            if(isset($_REQUEST['search'])){
              $index = 1;
              $msg = "";
              $value = $_REQUEST['searchby'];
              if($_REQUEST['select']=='RollNo'){
                $var = 'stud_rollno';
              }
              else{
                $var = 'stud_name';
              }
              $query = "SELECT * FROM Student WHERE approval_status = 0 AND $var='".$value."'";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  $msg .= "<tr id='".$index."'>
                              <td class='row-data'>".$row['stud_rollno']."</td>
                              <td class='row-data'>".$row['stud_name']."</td>
                              <td class='row-data'>".$row['stud_email']."</td>
                              <td class='row-data'>".$row['stud_mob']."</td>
                              <td>
                                <button class='btn btn-success' type='submit' name='approve' onclick='show()'>Approve</button>&nbsp;
                                <button class='btn btn-danger' type='submit' name='delete' onclick='show()'>Delete</button>
                              </td>
                            </tr>";
                }

              }
            }
            else{
              $index = 1;
              $msg = "";
              $query = "SELECT * FROM Student WHERE approval_status = 0";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  $msg .= "<tr id='".$index++."'>
                              <td class='row-data'>".$row['stud_rollno']."</td>
                              <td class='row-data'>".$row['stud_name']."</td>
                              <td class='row-data'>".$row['stud_email']."</td>
                              <td class='row-data'>".$row['stud_mob']."</td>
                              <td>
                                <button class='btn btn-success' type='submit' name='approve' onclick='show()'>Approve</button>&nbsp;
                                <button class='btn btn-danger' type='submit' name='delete' onclick='show()'>Delete</button>
                              </td>
                            </tr>";
                }

              }
            }
            $msg.="<table>";
            echo $msg;
          ?>
          <script>
              function show() {
                  var rowId = event.target.parentNode.parentNode.id;

                  var data = document.getElementById(rowId).querySelectorAll(".row-data");
                  var rollno = data[0].innerHTML;
                  document.getElementById('rollno').value = rollno;
              }
          </script>
      </div>
      <div class="col-sm-2 text-left">
      </div>
    </div>
  </form>
  <hr>
</div>

</body>
</html>
