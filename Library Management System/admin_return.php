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
  <?php
    if(isset($_REQUEST['return'])){
      $book = $_REQUEST["book_id"];
      $stud = $_REQUEST["stud_id"];
      $ret_date = $_REQUEST["return_d"];
      $chkdt = $ret_date;
      $month = substr($chkdt,4,3);
      if($month == 'Jan') $month = '01';
      else if($month == 'Feb') $month = '02';
      else if($month == 'Mar') $month = '03';
      else if($month == 'Apr') $month = '04';
      else if($month == 'May') $month = '05';
      else if($month == 'Jun') $month = '06';
      else if($month == 'Jul') $month = '07';
      else if($month == 'Aug') $month = '08';
      else if($month == 'Sep') $month = '09';
      else if($month == 'Oct') $month = '10';
      else if($month == 'Nov') $month = '11';
      else if($month == 'Dec') $month = '12';

      $date = substr($chkdt,7,3);
      $year = substr($chkdt,10,5);
      $ret_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
      $query = "UPDATE BookIssue SET return_date='".$ret_date."' WHERE book_id='".$book."' AND stud_rollno='".$stud."'";
      mysqli_query($con, $query);
      $query = "UPDATE Book SET issued=0 WHERE book_id='".$book."'";
      mysqli_query($con, $query);
      $msg = "<script>alert('Book Returned Successfully!!');</script>";
      echo $msg;
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
      <a class="navbar-brand" href=""><p style="margin-top:-3px;color:white;"><img src="assets/image/logo-book.png" alt="" width="40" height="35">&nbsp;LMS</p></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index_admin.php">Home</a></li>
        <li><a href="admin_book.php">Books</a></li>
        <li><a href="admin_stud.php">Students</a></li>
        <li><a href="admin_issue.php">Issue Book</a></li>
        <li class="active"><a href="">Return Book</a></li>
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
    <div class="col-sm-12 text-left">
      <h1>Return Books</h1>
      <hr>
    </div>
  </div>
  <br>
  <form class="" action="" method="POST">
    <div class="input-append" align="right" style="margin-right:35px;">
      <select size="1" name="select" class="form-select form-select-sm" aria-label=".form-select-sm example">
        <option value="BookID">BookID</option>
        <option value="RollNo">RollNo</option>
      </select>
      <input type="text" placeholder="search by" id="searchby" name="searchby"/>
      <button class="btn btn-info" name="search">Search</button>
    </div>

    <br>
    <div class="row content">
      <input type="hidden" id="book_id" name="book_id">
      <input type="hidden" id="stud_id" name="stud_id">
      <input type="hidden" id="return_d" name="return_d">
      <div class="col-sm-2 text-left">
      </div>
      <div class="col-sm-8 text-left">
        <table>
          <tr>
            <th>BookID</th>
            <th>Student Rollno</th>
            <th>Issued Date</th>
            <th>Return Date</th>
            <th></th>
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
              $query = "SELECT * FROM BookIssue WHERE return_date IS NULL AND ".$var."='".$value."'";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  $msg .= "<tr id='".$index."'>
                              <td class='row-data'>".$row['book_id']."</td>
                              <td class='row-data'>".$row['stud_rollno']."</td>
                              <td>".date("d/m/Y", strtotime($row['issue_date']))."</td>
                              <td class='row-data'><input type='date' id='ret_date".$index++."' name='ret_date'/></td>
                              <td><button class='btn btn-success' type='submit' name='return' onclick='show()'>Return</button></td>
                            </tr>";
                }

              }
            }
            else{
              $index = 1;
              $msg = "";
              $query = "SELECT * FROM BookIssue WHERE return_date IS NULL";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  $msg .= "<tr id='".$index."'>
                              <td class='row-data'>".$row['book_id']."</td>
                              <td class='row-data'>".$row['stud_rollno']."</td>
                              <td>".date("d/m/Y", strtotime($row['issue_date']))."</td>
                              <td class='row-data'><input type='date' id='ret_date".$index++."' name='ret_date'/></td>
                              <td><button class='btn btn-success' type='submit' name='return' onclick='show()'>Return</button></td>
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
                  var book = data[0].innerHTML;
                  var stud = data[1].innerHTML;
                  var date = document.getElementById('ret_date'+rowId).valueAsDate;
                  document.getElementById('book_id').value = book;
                  document.getElementById('stud_id').value = stud;
                  document.getElementById('return_d').value = date;
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
