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
        <li class="active"><a href="">Issued Book</a></li>
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
    <div class="col-sm-12 text-left">
      <h1>Issued Books</h1>
      <hr>
    </div>
  </div>
  <br>
  <form class="" action="" method="post">
    <div class="input-append" align="right" style="margin-right:35px;">
      <select size="1" name="select" class="form-select form-select-sm" aria-label=".form-select-sm example">
        <option value="BookID">BookID</option>
        <option value="RollNo">RollNo</option>
      </select>
      <input type="text" placeholder="search by" id="searchby" name="searchby"/>
      <button class="btn btn-info" name="search">Search</button>
    </div>
  </form>

  <br>
  <div class="row content">
    <div class="col-sm-2 text-left">
    </div>
    <div class="col-sm-8 text-left">
      <table>
        <tr>
          <th>BookID</th>
          <th>StudentID</th>
          <th>Issued Date</th>
          <th>Returned Date</th>
        </tr>
        <?php
          if(isset($_REQUEST['search'])){
            $index = 1;
            $msg = "";
            $value = $_REQUEST['searchby'];
            if($_REQUEST['select']=='BookID'){
              $var = 'book_id';
            }
            else{
              $var = 'stud_rollno';
            }
            $query = "SELECT * FROM BookIssue WHERE return_date IS NOT NULL AND ".$var."='".$value."'";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_assoc($result)){
                $msg .= "<tr id='".$index."'>
                            <td class='row-data'>".$row['book_id']."</td>
                            <td class='row-data'>".$row['stud_rollno']."</td>
                            <td>".date("d/m/Y", strtotime($row['issue_date']))."</td>
                            <td>".date("d/m/Y", strtotime($row['return_date']))."</td>
                          </tr>";
              }

            }
          }
          else{
            $index = 1;
            $msg = "";
            $query = "SELECT * FROM BookIssue WHERE return_date IS NOT NULL";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_assoc($result)){
                $msg .= "<tr id='".$index."'>
                            <td class='row-data'>".$row['book_id']."</td>
                            <td class='row-data'>".$row['stud_rollno']."</td>
                            <td>".date("d/m/Y", strtotime($row['issue_date']))."</td>
                            <td>".date("d/m/Y", strtotime($row['return_date']))."</td>
                          </tr>";
              }

            }
          }
          $msg.="<table>";
          echo $msg;
        ?>
    </div>
    <div class="col-sm-2 text-left">
    </div>
  </div>
  <hr>
</div>

</body>
</html>
